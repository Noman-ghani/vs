<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Doctors;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;

class UserController extends FrontController
{

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname'                     => 'required',
            'lastname'                      => 'required',
            'password'                      => 'nullable|confirmed|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        } else {
            $user = $request->user('api');
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            if ($user->save()) {
                return response()->json(['success' => true], 200);
            }
        }

        return response()->json(['Something went wrong while processing your request'], 400);
    }

    public function register(Request $request)
    {

        $data = [];
        if($request->image){
            $data[] = [
                'name'     => 'image',
                'contents' => fopen( $request->image->getPathname(), 'r' ),
                'filename' => $request->image->getClientOriginalName()
            ];
        }

        $fields = array_diff_key($request->all(), array_flip(['image']));
        foreach ($fields as $key => $value) {
            $data[] = ['name'=> $key, 'contents'=>$value];
        }
        
        $endpoint = url('securedportal/api/doctor/register');
        $client = new \GuzzleHttp\Client();

        try {
            
            $curlRequest = $client->post($endpoint, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . env('FRONTEND_API_KEY')
                    ],
                    'multipart'=>$data
                ]
            );
            
            echo $curlRequest->getBody();
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

}
