<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\HomeController;

/*
|--------------------------------------------------------------------------
| Token-based Authorized API Routes
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->as('api.v1.')->group(function () {
	Route::get('/home', [HomeController::class, 'home'])->name('home');
});
