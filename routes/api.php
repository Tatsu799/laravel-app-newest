<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('posts', [PostController::class, 'getData'])->name('posts.getData');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('{id}/edit', [PostController::class, 'update'])->name('posts.update');
    Route::delete('{id}/edit', [PostController::class, 'delete'])->name('posts.delete');
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/like', [LikeController::class, 'unlike'])->name('posts.unlike');
});

Route::post('/registerUser', [AuthController::class, 'registerUser'])->name('auth.registerUser');
Route::post('/loginUser', [AuthController::class, 'loginUser'])->name('auth.loginUser');
