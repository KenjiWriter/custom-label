<?php

use App\Http\Controllers\HomeController;
use App\Livewire\LabelCreator;
use App\Http\Controllers\LabelPreviewController;
use Illuminate\Support\Facades\Route;
use App\Models\LabelProject;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Główne strony
Route::get('/creator', LabelCreator::class)->name('label.creator');
Route::view('/galeria', 'gallery')->name('gallery');
Route::view('/o-nas', 'about')->name('about');
Route::view('/kontakt', 'contact')->name('contact');

// POPRAWIONY PATTERN UUID:
Route::get('/preview/{uuid}', [LabelPreviewController::class, 'show'])
    ->name('label.preview')
    ->where('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/settings/profile', function () {
    return view('settings.profile');
})->middleware(['auth', 'verified'])->name('settings.profile');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/checkout', function (Request $request) {
    $projectId = $request->get('project_id') ?? session('project_id');
    $project = null;
    
    // Debug: sprawdź co jest w URL i sesji
    logger('Checkout - project_id from URL: ' . $request->get('project_id'));
    logger('Checkout - project_id from session: ' . session('project_id'));
    logger('Checkout - final project_id: ' . $projectId);
    
    if ($projectId) {
        $project = LabelProject::find($projectId);
        logger('Checkout - found project', ['project' => $project ? $project->toArray() : null]);
    } else {
        $project = LabelProject::latest()->first();
        logger('Checkout - using latest project', ['project' => $project ? $project->toArray() : null]);
    }
    
    return view('checkout', compact('project'));
})->name('checkout');

Route::post('/checkout', function (Request $request) {
    $projectId = $request->input('project_id');
    if ($projectId) {
        session(['project_id' => $projectId]);
    }
    return response()->json(['success' => true]);
});

Route::get('/order-confirmation', function (Request $request) {
    $projectId = $request->get('project_id') ?? session('project_id');
    $project = null;
    
    // Debug: sprawdź co jest w URL i sesji
    logger('Order confirmation - project_id from URL: ' . $request->get('project_id'));
    logger('Order confirmation - project_id from session: ' . session('project_id'));
    logger('Order confirmation - final project_id: ' . $projectId);
    
    if ($projectId) {
        $project = LabelProject::find($projectId);
        logger('Order confirmation - found project', ['project' => $project ? $project->toArray() : null]);
    } else {
        $project = LabelProject::latest()->first();
        logger('Order confirmation - using latest project', ['project' => $project ? $project->toArray() : null]);
    }
    
    return view('order-confirmation', compact('project'));
})->name('order.confirmation');

Route::post('/order-confirmation', function (Request $request) {
    $projectId = $request->input('project_id');
    if ($projectId) {
        session(['project_id' => $projectId]);
    }
    return response()->json(['success' => true]);
});


Route::get('/login', function() {
    return view('login-page');
})->name('login');

Route::get('/register', function() {
    return view('login-page');
})->name('register');

// Newsletter unsubscribe routes
Route::get('/newsletter/unsubscribe/{token}', function($token) {
    $subscription = \App\Models\NewsletterSubscriber::where('unsubscribe_token', $token)->first();
    
    if ($subscription) {
        $subscription->unsubscribe();
        return view('newsletter.unsubscribed', ['success' => true]);
    }
    
    return view('newsletter.unsubscribed', ['success' => false]);
})->name('newsletter.unsubscribe');

// One-click unsubscribe for Gmail (POST request)
Route::post('/newsletter/unsubscribe/{token}', function($token) {
    $subscription = \App\Models\NewsletterSubscriber::where('unsubscribe_token', $token)->first();
    
    if ($subscription) {
        $subscription->unsubscribe();
        return response('Unsubscribed successfully', 200)
            ->header('Content-Type', 'text/plain');
    }
    
    return response('Subscription not found', 404)
        ->header('Content-Type', 'text/plain');
})->name('newsletter.unsubscribe.post');

require __DIR__.'/auth.php';
