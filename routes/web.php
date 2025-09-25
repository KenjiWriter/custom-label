<?php

use App\Http\Controllers\HomeController;
use App\Livewire\LabelCreator;
use App\Http\Controllers\LabelPreviewController;
use Illuminate\Support\Facades\Route;
use App\Models\LabelProject;

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

    Route::get('/checkout', function () {
    $projectId = session('project_id');
    $project = null;
    if ($projectId) {
        $project = LabelProject::find($projectId);
    } else {
        $project = LabelProject::latest()->first();
    }
    return view('checkout', compact('project'));
})->name('checkout');

Route::get('/order-confirmation', function () {
    $projectId = session('project_id');
    $project = null;
    if ($projectId) {
        $project = LabelProject::find($projectId);
    } else {
        $project = LabelProject::latest()->first();
    }
    return view('order-confirmation', compact('project'));
})->name('order.confirmation');


Route::get('/login', function() {
    return view('login-page');
})->name('login');

Route::get('/register', function() {
    return view('login-page');
})->name('register');

require __DIR__.'/auth.php';
