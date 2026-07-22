<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\StyleguideController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/styleguide', [StyleguideController::class, 'index'])->name('styleguide');

Route::prefix('styleguide/layouts')->name('styleguide.layouts.')->group(function () {
    Route::get('/guest', [StyleguideController::class, 'layoutGuest'])->name('guest');
    Route::get('/sidebar', [StyleguideController::class, 'layoutSidebar'])->name('sidebar');
    Route::get('/topbar', [StyleguideController::class, 'layoutTopbar'])->name('topbar');
    Route::get('/mix', [StyleguideController::class, 'layoutMix'])->name('mix');
});
