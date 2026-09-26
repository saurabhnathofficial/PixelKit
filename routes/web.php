<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ImageCompressionController;


Route::get('/', function () {
    return view('home.index');
});


Route::get(
    '/compress',
    [ImageCompressionController::class, 'index']
)->name('compress.index');


Route::post(
    '/compress',
    [ImageCompressionController::class, 'compress']
)->name('images.compress');


Route::get('/download/{filename}', function ($filename) {

    $path = 'optimized/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return Storage::disk('public')->download($path);

})->name('images.download');