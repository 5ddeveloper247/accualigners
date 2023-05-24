<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPatientFromWeb extends Notification
{
    use Queueable;
    protected $PasswordReset;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($PasswordReset)
    {
        $this->PasswordReset = $PasswordReset;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = 'accualigners://params?email='.$this->PasswordReset->email.'&token='.$this->PasswordReset->token.'&otp='.$this->PasswordReset->otp;
        return (new MailMessage)
                    ->greeting('Welcome!')
                    ->line('We are excited to have you get started. First, you need to confirm your account. Just press the button below.')
                    ->action('Click Here', $link)
                    ->line('If that does not work, copy and paste the folowing link in your browser:')
                    ->line($link);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
