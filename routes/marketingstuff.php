<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'marketingstuff'])->prefix('marketing-staff/')->as('Marketing.')->group(function () {

    Route::controller(App\Http\Controllers\MarketingOfficer\DashboardController::class)
    ->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('settings', 'settings')->name('settings');
        Route::post('settings', 'password')->name('change.password');
    });

        Route::controller(App\Http\Controllers\MarketingOfficer\LeadController::class)
        ->prefix('lead/')->as('lead.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('status-update/{id}', 'statusUpdate')->name('status.update');
            Route::get('delete/{id}/{name}', 'delete')->name('delete');
            Route::get('view/{id}', 'view')->name('view');
            Route::get('convert-client/{id}', 'convertClient')->name('convert.client');
            Route::post('contact-record-store', 'ContactRecordstore')->name('contact.record.store');
            Route::post('contact-date-store', 'Contactdatestore')->name('contact.date.store');
            Route::get('search', 'Search')->name('search');
        });


});
