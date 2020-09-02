<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\States;
use \App\Models\Cities;
use App\Models\Students;
use App\Models\StudentsTimespentLogs;
use App\Models\Mcqs;
use App\Models\McqsAnswers;
use App\Models\McqsAttempt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends FrontController
{
    // public function show($slug = null)
    // {
    //     $page = $slug ?? 'index';
    //     if(view()->exists($page)){
    //         if(method_exists($this, $slug) && is_callable(array($this, $slug))){
    //             $this->data['data'] = $this->$slug();
    //         }
    //         return view($page, $this->data)->render();
    //     }else{
    //         abort(404);
    //     }
    // }
    public function index()
    {
        return view('index', $this->data)->render();
    }

    public function lms()
    {
        $attempts = McqsAttempt::where('user_id', Auth::id())->select(['mcq_id'])->count();
        $doctor = Students::whereUserId(Auth::id())->first();
        
        $this->data['user'] = Auth::user()->firstname . ' ' . Auth::user()->lastname;
        $this->data['timespent'] = json_encode(StudentsTimespentLogs::where('user_id', Auth::id()));

        if($doctor->has_taken_pretest){
            $this->data['module'] = $doctor->module_id ?? 1;
            $this->data['section'] = $doctor->section_id ?? 1;
            $this->data['isAjax'] = request()->ajax();
            return view('modules', $this->data)->render();
        }else{
            $this->data['pretestCompleted'] = ($attempts > 0 && $doctor->has_taken_pretest == 0)?1:0;
            return view('pretest', $this->data)->render();
        }
    }

    public function login()
    {
        if (!Auth::check()) {
            return view('auth.login', $this->data)->render();
        } else {
            return redirect(\App\Providers\RouteServiceProvider::HOME);
        }
    }

    public function register()
    {
        if (!Auth::check()) {
            $province = States::get();
            $this->data['province'] = $province->map(function ($province) {
                $province['cities'] = Cities::where('state_id', $province->id)->get();
                return $province;
            });
            return view('auth.register', $this->data)->render();
        } else {
            return redirect(\App\Providers\RouteServiceProvider::HOME);
        }
    }

    public function thankyou()
    {
        return view('auth.thankyou', $this->data)->render();
    }
}
