<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;


/* ========= Home Controller =========== */
Route::get('/', [HomeController::class, 'homepage']);

Route::get('/home', [HomeController::class, 'handleHomeRoute'])->middleware('auth')
    ->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', HomeController::class);
});

/* ========= Admin Controller =========== */

// 포스트 관련 라우팅
// Route::get('/posts/create', [AdminController::class, 'create']);

// Route::get('/posts', [AdminController::class, 'index']);

// Route::post('/posts', [AdminController::class, 'store']);

// Route::delete('/posts/{id}', [AdminController::class, 'destroy']);

// Route::put('/posts/{id}', [AdminController::class, 'edit']);

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/', [AdminController::class, 'adminIndex'])->name('home');

    Route::resource('posts', AdminController::class);
});

/* ========= Admin Controller =========== */
