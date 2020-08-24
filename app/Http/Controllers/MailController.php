<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public static function sendEmail($to, $subject, $data)
    {
        if (is_array($to)) {
            try {
                Mail::send(['html'=>'mail'], ['content' => $data], function ($message) use ($to, $subject) {
                    $message->subject($subject);
                    $message->to($to['email'], $to['name']);
                });
                
                if (Mail::failures()) {
                    return ['error' => 'Sorry! We have some issues sending email to your address'];
                } else {
                    return ['msg'=>'Email Sent Successfully!'];
                }
            } catch (\Throwable $th) {
                return ['error'=>$th->getMessage()];
            }
        } else {
            throw new Exception("the recepient data should be an array with email and name", 1);
        }
    }

    public static function congratesEmail($to)
    {
        $data = "
        <a href='".url('/')."'><img src='".asset('assets/images/logo.jpg')."' alt='logo'></a>
        <h3>Dear (" . $to['name'] . "),</h3>
<p>Congratulations! You're registered for the Tuberculosis course. Please click on the login link below to start the training.</p>
<a href=" . url('/login') . ">" . url('/login') . "</a>
<br>
<strong>Happy Learning! </strong>
<br>
<strong>
    <br>
From,<br>
National Tuberculosis Program Team.
</strong>
        ";

       return MailController::sendEmail($to, 'Registered on National Tuberculosis Program', $data);
    }
}
