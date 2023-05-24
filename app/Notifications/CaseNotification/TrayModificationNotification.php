<?php

namespace App\Notifications\CaseNotification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrayModificationNotification extends Notification
{
    use Queueable;
    protected $case;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public function __construct($case)
     {
         $this->case = $case;
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
        return (new MailMessage)
                    // ->cc(['shahzaib1616@gmail.com'])
                    ->cc(['info@acculigners.com', 'arshad@accualigners.com', 'dr@nouman.io'])
                    ->subject('Acculigner | Modification Request')
                    ->greeting('Hello!')
                    ->line('Digital model of your teeth is ready to review. Please login your Acculigners account to review.')
                    ->action('View Case', route('doctor.case.show', ['case' => $this->case->id]));
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