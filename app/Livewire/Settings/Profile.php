<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $avatar;
    public $currentAvatar;

    protected $listeners = ['avatarUpdated' => 'handleAvatarUpdate'];

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->currentAvatar = Auth::user()->avatar;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Log profile update activity
        $user->logActivity('profile_updated', 'Zaktualizowano profil', 'Zmieniono dane osobowe');

        $this->dispatch('profile-updated', name: $user->name);
        
        session()->flash('message', 'Profil został zaktualizowany');
    }

    /**
     * Handle avatar upload automatically when file is selected.
     */
    public function updatedAvatar()
    {
        try {
            $this->validate([
                'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            ], [
                'avatar.required' => 'Wybierz zdjęcie do przesłania.',
                'avatar.image' => 'Plik musi być obrazem.',
                'avatar.mimes' => 'Zdjęcie musi być w formacie: jpeg, png, jpg, gif lub webp.',
                'avatar.max' => 'Zdjęcie nie może być większe niż 2MB.',
            ]);

            $user = Auth::user();

            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->update(['avatar' => $avatarPath]);

            // Update current avatar for display
            $this->currentAvatar = $avatarPath;
            $this->avatar = null;

            // Log avatar update activity
            $user->logActivity('profile_updated', 'Zaktualizowano zdjęcie profilowe', 'Dodano nowe zdjęcie profilowe');

            session()->flash('message', 'Zdjęcie profilowe zostało zaktualizowane');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->avatar = null;
            throw $e;
        } catch (\Exception $e) {
            $this->avatar = null;
            session()->flash('error', 'Wystąpił błąd podczas przesyłania zdjęcia: ' . $e->getMessage());
        }
    }

    /**
     * Remove the current user's avatar.
     */
    public function removeAvatar(): void
    {
        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->update(['avatar' => null]);
        $this->currentAvatar = null;

        // Log avatar removal activity
        $user->logActivity('profile_updated', 'Usunięto zdjęcie profilowe', 'Usunięto zdjęcie profilowe');

        session()->flash('message', 'Zdjęcie profilowe zostało usunięte');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}
