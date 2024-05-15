<?php

use Illuminate\Support\Facades\Route;

// Route::controller(App\Http\Controllers\AjaxController::class)
// ->group(function () {
//     Route::get('fetch-upazila', 'fetchupazila')->name('fetch.upazilas');
//     Route::get('fetch-unions', 'fetchUnions')->name('fetch.unions');
//     Route::get('fetch-product-info', 'FetchProductPrice')->name('fetch.product.info');
// });

Route::middleware(['auth', 'officestuff'])->group(function () {
    Route::controller(App\Http\Controllers\OfficeStuff\DashboardController::class)
    ->prefix('office-staff/')->as('Office.')->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('settings', 'settings')->name('settings');
        Route::post('settings', 'password')->name('change.password');
    });

    Route::controller(App\Http\Controllers\OfficeStuff\LeadController::class)
        ->prefix('office-staff/lead/')->as('Office.lead.')->group(function () {
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


