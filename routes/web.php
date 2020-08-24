<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'PageController@index');
Route::get('/register', 'PageController@register');
Route::get('/thankyou', 'PageController@thankyou');
Route::get('/login', 'PageController@login')->name('login');



Route::get('/securedportal/{any?}', function () {
    return view('home');
})->where('any', '^(?!api\/)[\/\w\.-]*');


// Route::get('/{any?}', 'PageController@show');

Route::post('/user/register', '\App\Http\Controllers\UserController@register');
Route::post('/login', '\App\Http\Controllers\Auth\LoginController@frontendLogin');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});


Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

// Password reset routes...
Route::get('/password/reset/{token}/{email}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');




/**
 * Pretest and modules action Routes
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/lms', 'PageController@lms');

    /**
     * Pretest
    */
    Route::get('/pretest/answersheet', 'PretestController@correctAnswers');
    Route::get('/pretest/question', 'PretestController@getQuestion');
    Route::post('/pretest/attempt', 'PretestController@attempt');

    /**
     * Modules
    */
    Route::post('/modules/section/update', '\App\Http\Controllers\ModulesController@updateDoctorCurrentSection');
    Route::post('/modules/timespent/update', '\App\Http\Controllers\ModulesController@updateDoctorTimespentLog');
    // Route::get('/modules/', function () {
    //     return view('modules');
    // })->name('modules');
});