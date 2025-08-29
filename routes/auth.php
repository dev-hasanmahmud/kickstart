<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
	RegisterController,
	LoginController,
	VerificationController,
	ForgotPasswordController,
    PasswordResetLinkController,
    NewPasswordController,
};

/*
|--------------------------------------------------------------------------
| Guest Routes (Only for Unauthenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'show'])->name('login');
    Route::post('login', [LoginController::class, 'login'])
        ->middleware('throttle:3,1')
        ->name('login.submit');

    Route::get('register', [RegisterController::class, 'show'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])
        ->middleware('throttle:3,1')
        ->name('register.submit');

    Route::get('email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:3,1'])
        ->name('verification.verify');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('throttle:3,1')
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->middleware('throttle:3,1')
        ->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated users (logged in) but email may NOT be verified yet
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
