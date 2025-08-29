<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Log,
};
use Illuminate\Validation\ValidationException;
use Throwable;
use App\Models\User;

class LoginController extends Controller
{
    public function show()
    {
        if (auth()->check()) {
            return redirect()->route('panel.home');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $credentials = $request->only('email', 'password');
            $remember = $request->filled('remember_me');

            $user = User::withTrashed()->where('email', $request->email)->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => 'This account does not exist in our records.',
                ]);
            }

            if ($user->trashed()) {
                throw ValidationException::withMessages([
                    'email' => 'This account has been deleted.',
                ]);
            }

            if (!Auth::attempt($credentials, $remember)) {
                throw ValidationException::withMessages([
                    'email' => 'Invalid credentials!',
                ]);
            }

            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {
                Auth::logout();

                throw ValidationException::withMessages([
                    'email' => 'Please verify your email.',
                ]);
            }

            if ($user->status != 1) {
                Auth::logout();

                throw ValidationException::withMessages([
                    'email' => 'Your account is inactive.',
                ]);
            }

            Log::channel('auth')->warning('Logged in successfully: ', [
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);

            return redirect()->intended('/home');
        } catch (ValidationException $e) {
            Log::channel('auth')->warning('Login failed: ', [
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

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Log::channel('auth')->warning('Logout successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect('/')->with('message', 'Logout successfully.');
        } catch (Throwable $e) {
            Log::channel('auth')->error('Logout failed. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return redirect('/')->withErrors('Logout failed. Please try again.');
        }
    }
}
