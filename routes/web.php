<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController; // Using the new generic name
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard / Feed
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

    // Generic "Post" Routes
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{tweet}', [PostController::class, 'destroy'])->name('posts.destroy');
    // Note: We keep {tweet} as the ID parameter because the Model is still named Tweet

        // Like/Unlike Route
        Route::post('/posts/{tweet}/like', [PostController::class, 'like'])->name('posts.like');

        // Edit & Update Routes
        Route::get('/posts/{tweet}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{tweet}', [PostController::class, 'update'])->name('posts.update');

    // User Profile Route
    Route::get('/users/{user}', [PostController::class, 'showUser'])->name('users.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';