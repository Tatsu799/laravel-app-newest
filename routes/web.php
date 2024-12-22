<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    // Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::get('{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
});

// Route::middleware('auth:web')->group(function () {
//     Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
//     Route::get('{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
// });

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
