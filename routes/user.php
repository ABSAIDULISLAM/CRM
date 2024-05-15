<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'user'])->group(function () {

    Route::controller(App\Http\Controllers\User\DashboardController::class)
    ->prefix('user/')->as('User.')->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('settings', 'settings')->name('settings');
        Route::post('settings', 'password')->name('change.password');
    });

    Route::controller(App\Http\Controllers\User\PaymentController::class)
    ->prefix('user/payment/')->as('User.payment.')->group(function () {
        Route::get('history', 'history')->name('history');
        Route::get('view/{inv}/{id}', 'view')->name('view');
    });



});
