<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\GuestController;

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('index');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';


