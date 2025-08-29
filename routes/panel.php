<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\{
	PanelHomeController,
	UserController,
	RoleController,
	ModuleController,
	SubModuleController,
	PermissionController,
};

/*
|--------------------------------------------------------------------------
| Authenticated & Verified Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::as('panel.')->group(function () {
	    Route::get('home', [PanelHomeController::class, 'home'])->name('home');
	    Route::get('profile', [PanelHomeController::class, 'profile'])->name('profile');
	    Route::patch('profile', [PanelHomeController::class, 'updateProfile'])->name('profile.submit');
	    Route::get('set-password', [UserController::class, 'setPassword'])->name('password.set');
		Route::post('set-password', [UserController::class, 'storePassword'])
			->middleware('throttle:3,1')
			->name('password.store');

		Route::resource('users', UserController::class);
		Route::resource('roles', RoleController::class);
		Route::resource('modules', ModuleController::class);
		Route::resource('sub-modules', SubModuleController::class);
		Route::resource('permissions', PermissionController::class);
	});
});
