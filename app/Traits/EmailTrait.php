<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Postmark\PostmarkClient;

trait EmailTrait
{
    public function sendMail($data, $view)
    {
        try {
            Mail::send($view, $data, function ($message) use ($data) {
//                if (array_key_exists('from', $data)) {
//                    $message->from($data['from'], 'Accu Aligners');
//                } else {
                    $message->from('noreply@accualigners.app', 'Accu Aligners');
//                }
                if (array_key_exists('subject', $data)) {
                    $message->subject($data['subject']);
                } else {
                    $message->subject("User Regestration");
                }
                $message->to($data['email']);
            });
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }


    public function sendMailViaPostMark($Maildata, $to, $subject)
    {
        $from = env('MAIL_FROM_ADDRESS');
        if($to == 'info@accualigners.com')
        {
            $from = 'admin@accualigners.com';
        }
        try {
            $client = new PostmarkClient(env("API_KEY_POSTMARK"));
            $client->sendEmail(
                $from,
                $to,
                $subject,
                $Maildata
            );
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    // public function sendMailViaPostMark($Maildata, $to, $from, $subject)
    // {
    //     $to = 'info@accualigners.com';
    //     try {
    //         $client = new PostmarkClient(env("API_KEY_POSTMARK"));
    //         $client->sendEmail(
    //             $from,
    //             $to,
    //             $subject,
    //             $Maildata
    //         );
    //         return true;
    //     } catch (\Throwable $e) {
    //         dd($e->getMessage()); // return the error message
    //     }
    // }

}
