<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageCompressionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home.index');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

});


/*
|--------------------------------------------------------------------------
| User Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Compress
    Route::get('/compress', [ImageCompressionController::class, 'index'])
        ->name('compress.index');

    Route::post('/compress', [ImageCompressionController::class, 'compress'])
        ->name('images.compress');


    // Resize
    Route::get('/resize', [ImageCompressionController::class, 'resizePage'])
        ->name('resize.index');

    Route::post('/resize', [ImageCompressionController::class, 'resize'])
        ->name('images.resize');


    // Convert
    Route::get('/convert', [ImageCompressionController::class, 'convertPage'])
        ->name('convert.index');

    Route::post('/convert', [ImageCompressionController::class, 'convert'])
        ->name('images.convert');


    // Download
    Route::get('/download/{filename}', [ImageCompressionController::class, 'download'])
        ->name('images.download');

});