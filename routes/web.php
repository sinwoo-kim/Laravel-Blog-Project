<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'homepage']);



route::get('/home', [HomeController::class, 'index'])->name('home');