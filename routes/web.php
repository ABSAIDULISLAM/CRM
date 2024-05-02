<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\GuestController;

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware('auth')->group(function(){
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [HomeController::class, 'profileUpdate'])->name('profile.update');

});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/officestuff.php';
require __DIR__.'/marketingstuff.php';
require __DIR__.'/user.php';


