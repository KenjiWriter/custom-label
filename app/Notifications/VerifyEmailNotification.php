<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends BaseVerifyEmailNotification
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->verificationUrl($notifiable));
        }

        return $this->buildMailMessage($this->verificationUrl($notifiable));
    }

    /**
     * Get the verify email URL for the given notifiable.
     */
    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Build the mail message.
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('✅ Weryfikacja adresu email - Custom Labels')
            ->view('emails.verify-email', ['url' => $url]);
    }
}
