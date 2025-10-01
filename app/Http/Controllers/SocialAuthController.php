<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(str()->random(16)),
                    'email_verified_at' => now(),
                    'google_id' => $googleUser->getId(),
                ]);
            } else {
                $user->update(['google_id' => $googleUser->getId()]);
            }
            
            Auth::login($user);
            Session::regenerate();
            
            return redirect()->intended(route('dashboard'));
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Wystąpił błąd podczas logowania przez Google.');
        }
    }

    // Microsoft
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback()
    {
        try {
            $microsoftUser = Socialite::driver('microsoft')->user();
            
            $user = User::where('email', $microsoftUser->getEmail())->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $microsoftUser->getName(),
                    'email' => $microsoftUser->getEmail(),
                    'password' => bcrypt(str()->random(16)),
                    'email_verified_at' => now(),
                    'microsoft_id' => $microsoftUser->getId(),
                ]);
            } else {
                $user->update(['microsoft_id' => $microsoftUser->getId()]);
            }
            
            Auth::login($user);
            Session::regenerate();
            
            return redirect()->intended(route('dashboard'));
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Wystąpił błąd podczas logowania przez Microsoft.');
        }
    }
}
