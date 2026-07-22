<?php

use App\Http\Controllers\StyleguideController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/styleguide');

Route::get('/styleguide', [StyleguideController::class, 'index'])->name('styleguide');

Route::prefix('styleguide/layouts')->name('styleguide.layouts.')->group(function () {
    Route::get('/guest', [StyleguideController::class, 'layoutGuest'])->name('guest');
    Route::get('/sidebar', [StyleguideController::class, 'layoutSidebar'])->name('sidebar');
    Route::get('/topbar', [StyleguideController::class, 'layoutTopbar'])->name('topbar');
    Route::get('/mix', [StyleguideController::class, 'layoutMix'])->name('mix');
});
