<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', '\App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
// Send reset password mail
Route::post('/reset_password', '\App\Http\Controllers\Auth\ForgotPasswordController@validateBackendEmail');

// Password reset routes...
Route::get('/reset_new_password/{token}', '\App\Http\Controllers\Auth\ResetPasswordController@validateToken')->name('password.reset');
Route::post('reset_new_password', '\App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.reset');

Route::group(['middleware' => 'frontend'], function () {
    Route::post('/student/register', '\App\Http\Controllers\StudentsController@store');
    Route::post('/trainer/register', '\App\Http\Controllers\TrainersController@store');
});


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', function (Request $request) {
        $user = $request->user('api');

        return [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email
        ];
    });

    Route::patch('/profile', '\App\Http\Controllers\UserController@updateProfile');
    Route::get('/getDashboadData', '\App\Http\Controllers\DashboardController@getDashboadData');

    Route::get('/role', '\App\Http\Controllers\RoleController@browse');
    Route::get('/role/edit/{id}', '\App\Http\Controllers\RoleController@get_by_id')->where('id', '[0-9]+');
    Route::post('/role/add', '\App\Http\Controllers\RoleController@store');
    Route::post('/role/edit/{id}', '\App\Http\Controllers\RoleController@update_by_id')->where('id', '[0-9]+');
    Route::post('/role/delete/{id}', '\App\Http\Controllers\RoleController@soft_delete_by_id')->where('id', '[0-9]+');
    
    
    Route::get('/permissions', '\App\Http\Controllers\PermissionsController@browse');
    Route::get('/permission/edit/{id}', '\App\Http\Controllers\PermissionsController@get_by_id')->where('id', '[0-9]+');
    Route::post('/permission/add', '\App\Http\Controllers\PermissionsController@store');
    Route::post('/permission/edit/{id}', '\App\Http\Controllers\PermissionsController@update_by_id')->where('id', '[0-9]+');
    Route::post('/permission/delete/{id}', '\App\Http\Controllers\PermissionsController@soft_delete_by_id')->where('id', '[0-9]+');
    
    Route::get('/allowed_permissions/{id}', '\App\Http\Controllers\AllowPermissionsController@get_by_id')->where('id', '[0-9]+');
    
    Route::get('/categories', '\App\Http\Controllers\CategoriesController@browse');
    Route::get('/category/edit/{id}', '\App\Http\Controllers\CategoriesController@get_by_id')->where('id', '[0-9]+');
    Route::post('/category/add', '\App\Http\Controllers\CategoriesController@store');
    Route::post('/category/edit/{id}', '\App\Http\Controllers\CategoriesController@update_by_id')->where('id', '[0-9]+');
    Route::post('/category/delete/{id}', '\App\Http\Controllers\CategoriesController@soft_delete_by_id')->where('id', '[0-9]+');
    
    Route::get('/students', '\App\Http\Controllers\StudentsController@browse');
    Route::get('/student/edit/{id}', '\App\Http\Controllers\StudentsController@get_by_id')->where('id', '[0-9]+');
    Route::post('/student/add', '\App\Http\Controllers\StudentsController@store');
    Route::post('/student/edit/{id}', '\App\Http\Controllers\StudentsController@update_by_id')->where('id', '[0-9]+');
    Route::post('/student/delete/{id}', '\App\Http\Controllers\StudentsController@soft_delete_by_id')->where('id', '[0-9]+');
    
    Route::get('/trainers', '\App\Http\Controllers\TrainersController@browse');
    Route::get('/trainer/edit/{id}', '\App\Http\Controllers\TrainersController@get_by_id')->where('id', '[0-9]+');
    Route::post('/trainer/add', '\App\Http\Controllers\TrainersController@store');
    Route::post('/trainer/edit/{id}', '\App\Http\Controllers\TrainersController@update_by_id')->where('id', '[0-9]+');
    Route::post('/trainer/delete/{id}', '\App\Http\Controllers\TrainersController@soft_delete_by_id')->where('id', '[0-9]+');
    
    
    Route::get('/settings', '\App\Http\Controllers\SettingsController@browse');
    Route::post('/settings/add', '\App\Http\Controllers\SettingsController@store');

    Route::get('getStates', 'APIController@getStates');
    Route::get('getStatesById/{id}', 'APIController@getStatesById')->where('id', '[0-9]+');
    Route::get('getCities', 'APIController@getCities');
    Route::post('uploadFile', 'APIController@uploadFile');
    Route::post('deleteFile', 'APIController@deleteFile');
    

    // Route::post('uploadImage','StudentsController@store');
});