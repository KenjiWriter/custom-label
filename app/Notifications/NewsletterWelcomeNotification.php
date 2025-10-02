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
        return (new MailMessage)
            ->subject('Witamy w newsletterze Custom Labels!')
            ->greeting('Witaj!')
            ->line('Dziękujemy za zapisanie się do naszego newslettera!')
            ->line('Będziesz otrzymywać najnowsze informacje o:')
            ->line('• Nowych funkcjach kreatora etykiet')
            ->line('• Promocjach i specjalnych ofertach')
            ->line('• Poradach dotyczących projektowania etykiet')
            ->line('• Inspiracjach i trendach w branży')
            ->action('Rozpocznij projektowanie', url('/'))
            ->line('Jeśli nie chcesz otrzymywać naszych wiadomości, możesz się wypisać w każdej chwili.')
            ->line('Dziękujemy za zaufanie!')
            ->salutation('Zespół Custom Labels');
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
