<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/
Route::as('web.')->group(function () {
	Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('about-us', [HomeController::class, 'aboutUs'])->name('about.us');
    Route::get('contact-us', [HomeController::class, 'contactUs'])->name('contact.us');
    Route::get('terms-and-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');
    Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
    Route::get('cookies-policy', [HomeController::class, 'cookiesPolicy'])->name('cookies.policy');
    Route::get('site-map', [HomeController::class, 'siteMap'])->name('site.map');
});
