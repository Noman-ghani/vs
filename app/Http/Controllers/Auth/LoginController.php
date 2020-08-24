<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'role_id' => 1, 'is_active' => 1 ], request('remember_me'))) {
            $user = Auth::user();
            $data = [
                'id' => $user->id,
                'name' => $user->firstname. ' ' .$user->firstname,
                'email' => $user->email,
                'token' => $user->api_token
            ];
            
            return response()->json($data, 200);
        }

        return response()->json(['error' => 'Invalid Credentials'], 400);
    }

    public function frontendLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'role_id'=>2, 'is_active'=>1], request('remember_me'))) {
            return redirect(RouteServiceProvider::HOME);
        }
        return redirect()->back()->withErrors(['password'=>'Invalid email or password'])->withInput();
    }
    
    public function logout(Request $request)
    {
        // update api token if user found
        $user = $request->user('api');

        if ($user) {
            $user->api_token = Str::random(60);
            $user->save();
        }
        
        return response()->json(['success' => true], 200);
    }
}