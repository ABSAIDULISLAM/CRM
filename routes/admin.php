<?php

use App\Http\Controllers\Admin\Account\MarketingStuffController;
use App\Http\Controllers\Admin\Account\OfficeStuffController;
use App\Http\Controllers\Admin\Account\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EstimateController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LeadOwnerController;
use App\Http\Controllers\Admin\LeadsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {

    Route::controller(AjaxController::class)
        ->group(function () {
            Route::get('fetch-subcat', 'fetchSubCat')->name('fetch.sub-cat');
            Route::get('fetch-product-info', 'FetchProductPrice')->name('fetch.product.info');
        });

    Route::controller(DashboardController::class)
        ->prefix('admin/')->as('Admin.')->group(function () {
            Route::get('dashboard', 'index')->name('dashboard');
            Route::get('profile', 'profile')->name('profile');
            Route::post('profile', 'profileUpdate')->name('profile.update');
            Route::get('settings', 'settings')->name('settings');
            Route::post('settings', 'password')->name('change.password');
        });

    Route::controller(ProductController::class)
        ->prefix('product/')->as('Product.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('view/{id}', 'view')->name('view');
            Route::get('status/{id}', 'status')->name('status');
            Route::get('search', 'Search')->name('search');
        });

    Route::controller(CategoryController::class)
        ->prefix('category/')->as('Category.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('status/{id}', 'status')->name('status');
        });

    Route::controller(SubCategoryController::class)
        ->prefix('sub-category/')->as('Sub-category.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('status/{id}', 'status')->name('status');
        });

    Route::controller(EstimateController::class)
        ->prefix('estimate/')->as('Estimate.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('view/{id}', 'view')->name('view');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('convert-invoice/{id}', 'convertInvoice')->name('convert.invoice');
            Route::get('search', 'Search')->name('search');
        });

    Route::controller(SalesController::class)
        ->prefix('sales/')->as('Sales.')->group(function () {
            Route::get('index', 'index')->name('index');
        });

    Route::controller(PaymentController::class)
        ->prefix('payment/')->as('Payment.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('receive', 'receive')->name('receive');
            Route::get('edit', 'edit')->name('edit');
        });

    Route::controller(InvoiceController::class)
        ->prefix('invoice/')->as('Invoice.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('view/{id}', 'view')->name('view');
            Route::get('delete/{id}', 'delete')->name('delete');

            Route::get('pay-now/{id}/{inv}/{payable}', 'payNow')->name('pay-now');
            Route::post('payment-store', 'paymentStore')->name('payment-store');

            Route::get('renewal-list', 'renewalList')->name('renewal.list');
            Route::get('search', 'Search')->name('search');
        });


    Route::controller(ServicesController::class)
        ->prefix('service/')->as('Service.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('renew', 'renew')->name('renew');
        });

    Route::controller(LeadsController::class)
        ->prefix('lead/')->as('Lead.')->group(function () {
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

    Route::controller(ClientController::class)
        ->prefix('client/')->as('Client.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('status-update/{id}', 'statusUpdate')->name('status.update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('view/{id}', 'view')->name('view');
            Route::get('search', 'Search')->name('search');
        });

    Route::controller(LeadOwnerController::class)
        ->prefix('lead-owner/')->as('Lead-owner.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('view/{id}', 'view')->name('view');
            // Route::get('status/{id}', 'status')->name('status');
        });


    Route::controller(SettingsController::class)
        ->prefix('settings/')->as('Settings.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('localization', 'localizeation')->name('localize');
            Route::get('payment', 'payment')->name('payment');
            Route::get('email', 'email')->name('email');
            Route::get('social-media', 'socialMedia')->name('social-media');
            Route::get('social-link', 'socialLink')->name('social-link');
            Route::get('seo', 'seo')->name('seo');
            Route::get('other', 'other')->name('other');
        });


    Route::controller(UserController::class)
        ->prefix('account/user')->as('Account.user.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('view/{id}', 'view')->name('view');

        });

    Route::controller(MarketingStuffController::class)
        ->prefix('account/marketing')->as('Account.marketing.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('view/{id}', 'view')->name('view');

        });

    Route::controller(OfficeStuffController::class)
        ->prefix('account/office')->as('Account.office.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('view/{id}', 'view')->name('view');

        });


});



