<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactForm extends Component
{
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';
    public $consent = false;
    public $isSubmitting = false;
    public $showSuccess = false;

    protected $rules = [
        'firstName' => 'required|min:2|max:50',
        'lastName' => 'required|min:2|max:50',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'subject' => 'required',
        'message' => 'required|min:10|max:1000',
        'consent' => 'accepted',
    ];

    protected $messages = [
        'firstName.required' => 'Imię jest wymagane.',
        'firstName.min' => 'Imię musi mieć co najmniej 2 znaki.',
        'lastName.required' => 'Nazwisko jest wymagane.',
        'lastName.min' => 'Nazwisko musi mieć co najmniej 2 znaki.',
        'email.required' => 'Email jest wymagany.',
        'email.email' => 'Podaj prawidłowy adres email.',
        'subject.required' => 'Wybierz temat wiadomości.',
        'message.required' => 'Wiadomość jest wymagana.',
        'message.min' => 'Wiadomość musi mieć co najmniej 10 znaków.',
        'message.max' => 'Wiadomość może mieć maksymalnie 1000 znaków.',
        'consent.accepted' => 'Musisz wyrazić zgodę na przetwarzanie danych osobowych.',
    ];

    public function submit()
    {
        $this->isSubmitting = true;
        
        try {
            $this->validate();

            // Prepare email data
            $emailData = [
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'email' => $this->email,
                'phone' => $this->phone,
                'subject' => $this->subject,
                'messageContent' => $this->message,
                'submitted_at' => now()->format('Y-m-d H:i:s'),
            ];

            // Send email
            Mail::send('emails.contact', $emailData, function ($mail) {
                $mail->to('CustomLabelHelps@gmail.com')
                     ->subject('Nowa wiadomość z formularza kontaktowego - ' . $this->subject)
                     ->replyTo($this->email, $this->firstName . ' ' . $this->lastName);
            });

            // Reset form
            $this->reset(['firstName', 'lastName', 'email', 'phone', 'subject', 'message', 'consent']);
            $this->showSuccess = true;

            // Hide success message after 5 seconds
            $this->dispatch('hide-success-message');

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            session()->flash('error', 'Wystąpił błąd podczas wysyłania wiadomości. Spróbuj ponownie.');
        }

        $this->isSubmitting = false;
    }

    public function hideSuccess()
    {
        $this->showSuccess = false;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}