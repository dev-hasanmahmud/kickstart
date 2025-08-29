<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Log,
    Hash,
    Password,
};
use App\Notifications\PasswordResetSuccess;
use Illuminate\Validation\ValidationException;
use Throwable;

class NewPasswordController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->route('token'),
            'email' => $request->email,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                    ])->save();

                    $user->notify(new PasswordResetSuccess());
                }
            );

            Log::channel('auth')->info('Password has been changed successfully: ', [
                'ip' => $request->ip(),
            ]);

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        } catch (ValidationException $e) {
            Log::channel('auth')->warning('Failed to reset password: ', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors());
        } catch (Throwable $e) {
            Log::channel('auth')->error('Something went wrong. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors(['email' => 'Something went wrong. Please try again.']);
        }
    }
}
