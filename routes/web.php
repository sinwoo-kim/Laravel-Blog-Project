<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


/* ========= Home Controller =========== */
Route::get('/', [HomeController::class, 'homepage']);

Route::get('/home', [HomeController::class, 'index'])->name('home');



/* ========= Admin Controller =========== */

// 포스트 관련 라우팅
// Route::get('/posts/create', [AdminController::class, 'create']);

// Route::get('/posts', [AdminController::class, 'index']);

// Route::post('/posts', [AdminController::class, 'store']);

// Route::delete('/posts/{id}', [AdminController::class, 'destroy']);

// Route::put('/posts/{id}', [AdminController::class, 'edit']);

Route::resource('posts', AdminController::class);