<?php
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    // Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // Obsłuż logowanie użytkownika
    }

    // Microsoft
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback()
    {
        $user = Socialite::driver('microsoft')->user();
        // Obsłuż logowanie użytkownika
    }
}
