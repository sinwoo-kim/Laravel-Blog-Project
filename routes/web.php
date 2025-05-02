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

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/', [AdminController::class, 'adminIndex'])->name('home');

    Route::resource('posts', AdminController::class);
    Route::patch('posts/{id}/status', [AdminController::class, 'postStatusUpdate'])->name('posts.status.update');
});

/* ========= Admin Controller =========== */
