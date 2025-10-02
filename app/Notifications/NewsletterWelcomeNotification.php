<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterWelcomeNotification extends Notification
{
    use Queueable;

    protected $unsubscribeToken;

    /**
     * Create a new notification instance.
     */
    public function __construct($unsubscribeToken)
    {
        $this->unsubscribeToken = $unsubscribeToken;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $unsubscribeUrl = url('/newsletter/unsubscribe/' . $this->unsubscribeToken);
        
        return (new MailMessage)
            ->subject('Witamy w newsletterze Custom Labels!')
            ->view('emails.newsletter-welcome', [
                'unsubscribeToken' => $this->unsubscribeToken
            ])
            ->withSymfonyMessage(function ($message) use ($unsubscribeUrl) {
                $headers = $message->getHeaders();
                
                // Dodaj List-Unsubscribe header (dla Gmail, Outlook, etc.)
                $headers->addTextHeader('List-Unsubscribe', '<' . $unsubscribeUrl . '>');
                
                // Dodaj List-Unsubscribe-Post header (dla jednego kliknięcia)
                $headers->addTextHeader('List-Unsubscribe-Post', 'List-Unsubscribe=One-Click');
                
                // Dodaj List-ID header
                $headers->addTextHeader('List-ID', 'Custom Labels Newsletter <newsletter.customlabels.com>');
                
                // Dodaj Precedence header
                $headers->addTextHeader('Precedence', 'bulk');
            });
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
