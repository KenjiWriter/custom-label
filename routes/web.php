<?php

use App\Http\Controllers\HomeController;
use App\Livewire\LabelCreator;
use App\Http\Controllers\LabelPreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/creator', LabelCreator::class)->name('label.creator');
Route::get('/preview/{uuid}', [LabelPreviewController::class, 'show'])->name('label.preview');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';