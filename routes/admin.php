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

    // ajax calling routes
    Route::controller(AjaxController::class)
        ->group(function () {
            Route::get('fetch-upazila', 'fetchupazila')->name('fetch.upazilas');
            Route::get('fetch-unions', 'fetchUnions')->name('fetch.unions');
            Route::get('fetch-product-info', 'FetchProductPrice')->name('fetch.product.info');
            Route::get('fetch-sub-cat', 'fetchSubCat')->name('fetch.sub-cat');
        });

Route::middleware(['auth', 'admin'])->group(function () {

    Route::controller(DashboardController::class)
        ->prefix('admin/')->as('Admin.')->group(function () {
            Route::get('dashboard', 'index')->name('dashboard');
            Route::get('profile', 'profile')->name('profile');
            Route::post('profile', 'profileUpdate')->name('profile.update');
            Route::get('settings', 'settings')->name('settings');
            Route::post('settings', 'password')->name('change.password');
        });
    // Product routes
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
    // Category routes
    Route::controller(CategoryController::class)
        ->prefix('category/')->as('Category.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('status/{id}', 'status')->name('status');
        });
    // Subcategory routes
    Route::controller(SubCategoryController::class)
        ->prefix('sub-category/')->as('Sub-category.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('status/{id}', 'status')->name('status');
        });
    // Estimate routes
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
    // sales routes
    Route::controller(SalesController::class)
        ->prefix('sales/')->as('Sales.')->group(function () {
            Route::get('index', 'index')->name('index');
        });
    // Payment routes
    Route::controller(PaymentController::class)
        ->prefix('payment/')->as('Payment.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('receive', 'receive')->name('receive');
            Route::get('edit', 'edit')->name('edit');
            Route::get('view/{inv}/{id}', 'view')->name('view');

        });
    // Invoice routes
    Route::controller(InvoiceController::class)
        ->prefix('invoice/')->as('Invoice.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get( 'view/{id}', 'view')->name('view');
            Route::get('delete/{id}', 'delete')->name('delete');

            Route::get('pay-now/{id}/{inv}/{payable}', 'payNow')->name('pay-now');
            Route::post('payment-store', 'paymentStore')->name('payment-store');

            Route::get('search', 'Search')->name('search');
        });

    // Service routes
    Route::controller(ServicesController::class)
        ->prefix('service/')->as('Service.')->group(function () {
            Route::get('index', 'renewalList')->name('renewal.list');
            Route::get('renew', 'renew')->name('renew');
            Route::post('renew/store', 'renewStore')->name('renew.store');
            Route::post('send/message', 'sendMessage')->name('send.message');

            // Route::get('renewal-list', 'index')->name('index');
        });
    // Lead routes
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
    // Client routes
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
    // Lead Owner/ Marketing Officer routes
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

    // setting routes
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

    // User routes
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
    // Marketing routes
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
    // Offic Stuff routes
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
