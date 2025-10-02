<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber;
use App\Notifications\NewsletterWelcomeNotification;
use Illuminate\Support\Facades\Notification;

class NewsletterSubscription extends Component
{
    public $email = '';
    public $isSubscribed = false;
    public $message = '';

    protected $rules = [
        'email' => 'required|email|max:255',
    ];

    protected $messages = [
        'email.required' => 'Adres email jest wymagany.',
        'email.email' => 'Podaj prawidłowy adres email.',
        'email.max' => 'Adres email jest zbyt długi.',
    ];

    public function subscribe()
    {
        $this->validate();

        // Sprawdź czy email już istnieje
        $existingSubscription = NewsletterSubscriber::where('email', $this->email)->first();

        if ($existingSubscription) {
            if ($existingSubscription->status === 'active') {
                $this->message = 'Ten adres email jest już zapisany do newslettera.';
                $this->isSubscribed = false;
                return;
            } else {
                // Reaktywuj subskrypcję
                $existingSubscription->update([
                    'status' => 'active',
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null,
                ]);
            }
        } else {
            // Utwórz nową subskrypcję
            $existingSubscription = NewsletterSubscriber::create([
                'email' => $this->email,
                'status' => 'active',
            ]);
        }

        // Wyślij email powitalny
        try {
            Notification::route('mail', $this->email)
                ->notify(new NewsletterWelcomeNotification($existingSubscription->unsubscribe_token));
            
            $this->message = 'Dziękujemy za zapisanie się do newslettera! Sprawdź swoją skrzynkę pocztową.';
            $this->isSubscribed = true;
            $this->email = '';
        } catch (\Exception $e) {
            $this->message = 'Wystąpił błąd podczas wysyłania emaila. Spróbuj ponownie.';
            $this->isSubscribed = false;
        }
    }

    public function render()
    {
        return view('livewire.newsletter-subscription');
    }
}
