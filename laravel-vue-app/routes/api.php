<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\AbilitiesController;
use App\Http\Controllers\Api\V1\Admin\LocalesController;
use App\Http\Controllers\Api\V1\Admin\PermissionsApiController;
use App\Http\Controllers\Api\V1\Admin\RolesApiController;
use App\Http\Controllers\Api\V1\Admin\UsersApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Abilities
    Route::apiResource('abilities', AbilitiesController::class, ['only' => ['index']]);

    // Locales
    Route::get('locales/languages', [LocalesController::class, 'languages'])->name('locales.languages');
    Route::get('locales/messages', [LocalesController::class, 'messages'])->name('locales.messages');

    // Permissions
    Route::resource('permissions', PermissionsApiController::class);

    // Roles
    Route::resource('roles', RolesApiController::class);

    // Users
    Route::resource('users', UsersApiController::class);
});

