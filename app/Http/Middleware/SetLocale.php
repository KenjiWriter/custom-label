<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Get language from session or default to Polish
        $locale = Session::get('locale', 'pl');
        
        // Set the application locale
        App::setLocale($locale);
        
        return $next($request);
    }
}