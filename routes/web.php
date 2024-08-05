<?php

use App\Http\Controllers\VideoController;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos', [VideoController::class, 'index']);

Route::get('/video/{video}',[VideoController::class, 'show'])->name('video.show');
