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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['api'], 'prefix' => 'api'], function () {

    Route::post('user', ['uses' => '\App\Capstone\User\Controller\UserController@createUser']);

    Route::post('login', ['uses' => '\App\Capstone\User\Controller\UserController@login']);

    Route::get('logout', ['uses' => '\App\Capstone\User\Controller\UserController@logout']);

    Route::group(['prefix' => 'profile'], function () {

        Route::post('image/{userId}', ['uses' => '\App\Capstone\Profile\Controller\ProfileController@updateImage']);

        Route::post('bio/{userId}', ['uses' => '\App\Capstone\Profile\Controller\ProfileController@updateBio']);

        Route::post('rate/{userId}', ['uses' => '\App\Capstone\Profile\Controller\ProfileController@updateRate']);

        Route::post('skills/{userId}', ['uses' => '\App\Capstone\Profile\Controller\ProfileController@updateSkills']);

        Route::post('postcode/{userId}', ['uses' => '\App\Capstone\Profile\Controller\ProfileController@updatePostcode']);

        Route::get('{userId}', ['uses' => '\App\Capstone\Profile\Controller\ProfileController@getProfileByUserId']);
    });

    Route::group(['prefix' => 'profiles'], function() {
        Route::get('/', ['uses' => '\App\Capstone\Profile\Controller\ProfileController@getAllProfiles']);
    });

    Route::group(['prefix' => 'postcode'], function() {
        Route::get('search/{postcode}', ['uses' => '\App\Capstone\Profile\Controller\ProfileController@getProfilesByPostcode']);
    });
});
