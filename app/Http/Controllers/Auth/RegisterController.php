<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\{
    Auth,
    Log,
};
use Illuminate\Validation\ValidationException;
use App\Models\{
    Role,
    User,
};
use Throwable;

class RegisterController extends Controller
{
    public function show(Request $request)
    {
        $role = $request->query('as');

        if (!in_array($role, ['author', 'editor'])) {
            throw ValidationException::withMessages([
                'name' => 'Something went wrong, please try again.',
            ]);

            Log::channel('auth')->warning('Something went wrong, please try again: ', [
                'ip' => $request->ip(),
            ]);
        }

        return view('auth.register', compact('role'));
    }
    
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed|min:8',
                'as' => 'required|in:author,editor',
                'i_agree' => 'accepted',
            ]);

            $roleId = Role::where('name', $validated['as'])
              ->where('status', 1)
              ->value('id');
              
            if (!$roleId) {
                throw ValidationException::withMessages([
                    'name' => 'Something went wrong, please try again.',
                ]);

                Log::channel('auth')->warning('Something went wrong, please try again: ', [
                    'ip' => $request->ip(),
                ]);
            }

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role_id' => $roleId ?? 1,
                'i_agree' => $request->boolean('i_agree'),
            ]);

            event(new Registered($user));

            Log::channel('auth')->warning('Registered successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('verification.notice');
        } catch (ValidationException $e) {
            Log::channel('auth')->warning('Registration validation failed.', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors())->withInput();
        } catch (Throwable $e) {
            Log::channel('auth')->error('Registration failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors([
                'email' => 'Something went wrong. Please try again later.'
            ])->withInput();
        }
    }
}
