<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Notifications\WelcomeNewUser;
use Illuminate\Validation\ValidationException;
use Throwable;

class VerificationController extends Controller
{   
    public function verify(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            if (! hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
                return redirect('/login')->withErrors([
                    'email' => 'The verification link is invalid.',
                ]);
            }

            if (! $user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
                event(new Verified($user));
            }

            $user->update([
                'status' => 1,
            ]);

            $user->notify(new WelcomeNewUser);

            Log::channel('auth')->warning('Email verified successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect('/login')->with('message', 'Email verified successfully!');
        } catch (ValidationException $e) {
            Log::channel('auth')->warning('Email verification failed: Invalid hash.', [
                'user_id' => $request->id,
                'ip' => $request->ip(),
            ]);

            return redirect('/login')->withErrors($e->errors());
        } catch (Throwable $e) {
            Log::channel('auth')->error('Email verification error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_id' => $request->id,
                'ip' => $request->ip(),
            ]);

            return redirect('/login')->withErrors([
                'email' => 'Something went wrong during verification. Please try again later.',
            ]);
        }
    }
}
