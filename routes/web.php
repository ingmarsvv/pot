<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', [VideoController::class, 'index'])->name('video.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Serves video stream
Route::get('/videos/serve/{filename}', [VideoController::class, 'serve'])->name('video.serve');
//filter videos
Route::get('/categories/{name}', [CategoryController::class, 'filterCategory'])->name('category.filter');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Show "Create video" form
    Route::get('/videos/create', [VideoController::class, 'create'])->name('video.create');
    //Store Video
    Route::post('/videos', [VideoController::class, 'store'])->name('video.store');
    //delete video
    Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('video.destroy');
    //Single Video
    Route::get('/videos/{video}', [VideoController::class, 'show'])->name('video.show');
    //Show edit form
    Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('video.edit');
    //Edit video
    Route::put('/videos/{video}', [VideoController::class, 'update'])->name('video.update');
    
    //Like video
    Route::post('/videos/{video}/like', [LikeController::class, 'store'])->name('video.storeLike');
    //Show "Create category" form
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    //Store category
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    // //filter videos
    // Route::get('/categories/{name}', [CategoryController::class, 'filterCategory'])->name('category.filter');
    Route::post('/comments/{video}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('/subscriptions/{category}', [SubscriptionController::class, 'subscribe'])->name('subscription.subscribe');
    
    Route::get('/admin', [VideoController::class, 'admin'])->name('video.admin');
});

require __DIR__.'/auth.php';
