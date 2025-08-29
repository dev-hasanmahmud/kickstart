<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\{
    StoreUserRequest,
    UpdateUserRequest,
};
use App\Services\{
    UserService,
    ListService,
};
use Illuminate\Support\Facades\{
    Log,
    Hash,
    Password,
};
use Illuminate\Support\Facades\Notification;
use App\Notifications\{
    PasswordSet,
    WelcomeNewUser,
    DeleteUserSuccess,
};
use Illuminate\Validation\ValidationException;
use Throwable;
use App\Constants\ListDefaults;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'role_id' => 'nullable|exists:roles,id',
            'status' => 'nullable|in:0,1',
        ]);

        $filters = $request->only(['search', 'start_date', 'end_date', 'role_id', 'status']);
        $users = $this->service->paginate(
            ListDefaults::PER_PAGE, 
            ListDefaults::COLUMNS, 
            $filters
        );
        $roles = (new ListService())->roleList();
        $sl = ($users->currentPage() - 1) * $users->perPage() + 1;

        return view('panel.users.index', compact('users', 'roles', 'sl'));
    }

    public function create()
    {
        $roles = (new ListService())->roleList();

        return view('panel.users.create', compact('roles'));
    }

    public function show($user)
    {
        $user = $this->service->find($user);

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'No record found.']);
        }

        $html = view('panel.users.detail-modal', compact('user'))->render();

        return response()->json(['status' => true, 'data' => $html]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->service->store($request->validated());
            $token = Password::broker()->createToken($user);
            $user->notify(new PasswordSet($token));

            Log::channel('panel')->info('User created successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.users.index')
                ->with('success', 'User created successfully and set password email sent.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to create user: ', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors());
        } catch (Throwable $e) {
            Log::channel('panel')->error('Something went wrong. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function edit($id)
    {
        $user = $this->service->find($id);
        $roles = (new ListService())->roleList();

        return view('panel.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());

            Log::channel('panel')->info('User updated successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.users.index')->with('success', 'User updated successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to update user: ', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors());
        } catch (Throwable $e) {
            Log::channel('panel')->error('Something went wrong. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->service->find($id);
            $name = $user->name;
            $email = $user->email;
            $user->delete();
            Notification::route('mail', $email)->notify(new DeleteUserSuccess($name));

            Log::channel('panel')->info('User deleted successfully: ', [
                'ip' => request()->ip(),
            ]);

            return redirect()->route('panel.users.index')->with('success', 'User deleted successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to delete user: ', [
                'errors' => $e->errors(),
                'ip' => request()->ip(),
            ]);

            return back()->withErrors($e->errors());
        } catch (Throwable $e) {
            Log::channel('panel')->error('Something went wrong. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => request()->ip(),
            ]);

            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function setPassword(Request $request)
    {
        return view('panel.users.set-password', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function storePassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            $status = Password::broker()->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                        'email_verified_at' => now(),
                        'i_agree' => 1,
                        'status' => 1,
                    ])->save();

                    $user->notify(new WelcomeNewUser);
                }
            );

            Log::channel('panel')->info('Password set successfully: ', [
                'ip' => $request->ip(),
            ]);

            return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', 'Password set successfully.')
                : back()->withErrors(['email' => [__($status)]]);
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to set password: ', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors());
        } catch (Throwable $e) {
            Log::channel('panel')->error('Something went wrong. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors(['password' => 'Something went wrong. Please try again.']);
        }
    }
}
