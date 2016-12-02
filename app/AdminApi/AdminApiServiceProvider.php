<?php

namespace App\AdminApi;


use Illuminate\Support\ServiceProvider;

class AdminApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Route::group(['prefix' => '/admin'], function () {
            \Route::get('/apartment', 'App\AdminApi\Controllers\ApartmentController@get');
            \Route::post('/apartment', 'App\AdminApi\Controllers\ApartmentController@create');
            \Route::get('/apartment/{id}', 'App\AdminApi\Controllers\ApartmentController@detail');
            \Route::delete('/apartment/{id}', 'App\AdminApi\Controllers\ApartmentController@delete');
            \Route::put('/apartment/{id}', 'App\AdminApi\Controllers\ApartmentController@update');

            \Route::get('/application', 'App\AdminApi\Controllers\ApplicationController@get');
            \Route::post('/application', 'App\AdminApi\Controllers\ApplicationController@create');
            \Route::get('/application/{id}', 'App\AdminApi\Controllers\ApplicationController@detail');
            \Route::delete('/application/{id}', 'App\AdminApi\Controllers\ApplicationController@delete');
            \Route::put('/application/{id}', 'App\AdminApi\Controllers\ApplicationController@update');

            \Route::get('/user', 'App\AdminApi\Controllers\UserController@get');
            \Route::post('/user', 'App\AdminApi\Controllers\UserController@create');
            \Route::get('/user/{id}', 'App\AdminApi\Controllers\UserController@detail');
            \Route::delete('/user/{id}', 'App\AdminApi\Controllers\UserController@delete');
            \Route::put('/user/{id}', 'App\AdminApi\Controllers\UserController@update');

            \Route::get('/review', 'App\AdminApi\Controllers\ReviewController@get');
            \Route::post('/review', 'App\AdminApi\Controllers\ReviewController@create');
            \Route::get('/review/{id}', 'App\AdminApi\Controllers\ReviewController@detail');
            \Route::delete('/review/{id}', 'App\AdminApi\Controllers\ReviewController@delete');
            \Route::put('/review/{id}', 'App\AdminApi\Controllers\ReviewController@update');
        });
    }

    public function register()
    {
        // TODO: Implement register() method.
    }
}