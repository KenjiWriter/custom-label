<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $language = $request->input('lang');
        
        // Validate language
        if (in_array($language, ['pl', 'en'])) {
            Session::put('locale', $language);
        }
        
        return redirect()->back();
    }
}