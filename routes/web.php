<?php

use App\Models\Video;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Storage;

//All videos
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [VideoController::class, 'index']);

//Show "Create video" form
Route::get('/videos/create', [VideoController::class, 'create'])->name('video.create');

//Store Video
Route::post('/videos', [VideoController::class, 'store'])->name('video.store');

//Single Video
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('video.show');

Route::get('/videos/serve/{filename}', [VideoController::class, 'serve'])->name('video.serve');

