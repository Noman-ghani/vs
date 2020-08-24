<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;



    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required','confirmed','min:8', function ($attribute, $value, $fail) {
                                if (Hash::check($value, \App\User::where('email', request()->email)->first()->password)) {
                                    $fail('New '.$attribute.' must be different');
                                }
                            }],
            'password_confirmation' => 'required',
        ];
    }

    public function validateToken($name) {
       
        $records =  DB::table('password_resets')->get();
        foreach ($records as $record) {
            if (Hash::check($name, $record->token) ) {
            return response()->json(['email' => $record->email], 200);
            }
        }
        return response()->json(['error' => "something went wrong or Expire token please check."], 422);
    }
}
