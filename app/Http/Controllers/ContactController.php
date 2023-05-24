<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Mail\MyTestMail;
use App\Mail\Test2;
use Mail;
use Exception;
use Postmark\PostmarkClient;

class ContactController extends Controller
{
    public function sendDemoMail()
    {
        try {
            // Mail::to('ali.raza@koderlabs.com')->send(new Test2());
            $client = new PostmarkClient("3eea77e5-11c5-447d-80e7-08a7a1d48cec");
            // Send an email:
            $sendResult = $client->sendEmail(
              "info@accualigners.com",
              "ali.raza@koderlabs.com",
              "Hello from Postmark!",
              "This is just a friendly 'hello' from your friends at Postmark."
            );
            dd("Mail has been sent successfully");
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
    public function test()
    {
        try {

            Mail::to('ali.raza@koderlabs.com')->send(new Test2());
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        dd("Mail has been sent successfully");
    }
    public function myDemoMail()
    {
        try {
            $myEmail = 'ali.raza@koderlabs.com';
            $details = [
                'title' => 'Mail Demo from ItSolutionStuff.com',
                'url' => 'https://www.itsolutionstuff.com'
            ];
            Mail::to($myEmail)->send(new MyDemoMail($details));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        dd("Mail Send Successfully");
    }
}
