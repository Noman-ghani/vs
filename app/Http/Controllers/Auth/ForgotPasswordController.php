<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Send password reset link. 
     */
    public function sendPasswordResetLink(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(['email' => trans($response)])->withInput($request->only('email'));
    }
    
    public function validateBackendEmail(Request $request) {
            
            $response = Password::sendResetLink(['email' => $request->email], function (Message $message) {
                $message->subject($this->getEmailSubject());
            });

            switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json(['message' => trans($response)], 200);
            case Password::INVALID_USER:
                return response()->json(['error' => trans($response)], 422);
        }

            return trans($response);
        
    }
}