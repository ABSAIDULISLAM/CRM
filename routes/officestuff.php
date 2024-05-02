<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'officestuff'])->group(function () {
    Route::controller(App\Http\Controllers\OfficeStuff\DashboardController::class)
    ->prefix('office-stuff/')->as('Office.')->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('settings', 'settings')->name('settings');
        Route::post('settings', 'password')->name('change.password');
    });

});
