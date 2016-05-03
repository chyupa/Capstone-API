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

    Route::post('user', ['uses' => '\App\User\Controller\UserController@createUser']);

    Route::post('login', ['uses' => '\App\User\Controller\UserController@login']);

    Route::get('logout', ['uses' => '\App\User\Controller\UserController@logout']);

    Route::group(['prefix' => 'profile'], function () {
        Route::post('bio/{userId}', ['uses' => '\App\Profile\Controller\ProfileController@updateBio']);

        Route::post('rate/{userId}', ['uses' => '\App\Profile\Controller\ProfileController@updateRate']);

        Route::post('skills/{userId}', ['uses' => '\App\Profile\Controller\ProfileController@updateSkills']);

        Route::post('postcode/{userId}', ['uses' => '\App\Profile\Controller\ProfileController@updatePostcode']);
    });


    Route::post('update/{profileId}', ['uses' => 'ProfileController@updateProfile']);

    Route::get('profiles', function () {
        return "asd";
    });


});
