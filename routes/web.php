<?php

use App\Http\Controllers\StyleguideController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/styleguide');

Route::get('/styleguide', [StyleguideController::class, 'index'])->name('styleguide');
