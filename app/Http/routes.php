<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['middleware' => ['api'], 'prefix' => 'api'], function () {

    Route::post('user', ['uses' => 'User@createUser']);

    Route::post('profile', ['uses' => '\App\Profile\Controller\ProfileController@createProfile']);
    Route::post('update/{profileId}', ['uses' => 'ProfileController@updateProfile']);

    Route::get('profiles', function () {
        return "asd";
    });


});
