<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class forgotPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $reset_code;
    public function __construct($code)
    {
        $this->reset_code = $code;
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
                    ->greeting('Hi!')
                    ->line('A password reset for the account with this email has been requested.')
                    // ->action('Notification Action', url('/'))
                    ->line('Please enter code below in your password reset page.')
                    ->line($this->reset_code)
                    ->line('If you did not request a password request, please ignore this message.')
                    // ->line('Thank you for using our application!');
                    ->subject('Reset Password');
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
