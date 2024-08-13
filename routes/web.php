<?php

use App\Models\Video;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryController;

//All videos
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [VideoController::class, 'index'])->name('video.index');

//Show "Create video" form
Route::get('/videos/create', [VideoController::class, 'create'])->name('video.create');

//Store Video
Route::post('/videos', [VideoController::class, 'store'])->name('video.store');

//delete video
Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('video.destroy');

//Single Video
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('video.show');

//Serves video stream
Route::get('/videos/serve/{filename}', [VideoController::class, 'serve'])->name('video.serve');

Route::get('/categories/{category}', [CategoryController::class, 'filterCategory'])->name('category.filter');


