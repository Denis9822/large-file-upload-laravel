<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::post('/file-upload', [MainController::class, 'fileUpload'])->name('file-upload');
