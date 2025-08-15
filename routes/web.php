<?php

use App\Http\Controllers\HomeController;
use App\Livewire\LabelCreator;
use App\Http\Controllers\LabelPreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/creator', LabelCreator::class)->name('label.creator');

// POPRAWIONY PATTERN UUID:
Route::get('/preview/{uuid}', [LabelPreviewController::class, 'show'])
    ->name('label.preview')
    ->where('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
