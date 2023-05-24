<?php

namespace App\Notifications\CaseNotification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TreatmentPlanNotification extends Notification
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
                    ->cc(['info@acculigners.com', 'arshad@accualigners.com', 'dr@nouman.io'])
                    ->subject('Acculigner | Clears Aligner Payment')
                    ->greeting('Hello!')
                    ->line('Clears Aligner payment has been received against case Id ')
                    ->action('View Case', route('admin.case.show', ['case' => $this->case->id]));

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
