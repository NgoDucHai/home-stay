<?php


use App\Http\Middleware\searchApartmentMiddleware;
use App\Http\Middleware\storeApartmentMiddleware;

Route::group(['middleware' => ['web']], function () {

    // Authentication route
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
    // Registration routes
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    Route::get('/', function () {
        return view('index');
    });
    //    apartment
    Route::get('/apartments', 'ApartmentController@index');

    Route::get('/apartment/{id}', ['as'=>'apartment.read','uses'=>'ApartmentController@read']);

    Route::post('/apartment',[
        'middleware' => storeApartmentMiddleware::class,
        'uses'       => 'ApartmentController@store'
    ]);

    Route::get('/apartment/{id}/edit', 'ApartmentController@edit');

    Route::delete('/apartment/{id}', 'ApartmentController@destroy');
    //    image

    Route::get('/add', 'ImageController@create');
    Route::post('/dropzone/store', ['as'=>'dropzone.store','uses'=>'ImageController@store']);

    //    search
    Route::get('/search', [
        'middleware' => searchApartmentMiddleware::class,
        'uses'       => 'ApartmentController@search'
    ]);

    // application
    Route::post('/application', 'ApplicationController@create');
    Route::get('/sendemail', 'ApplicationController@sendEmial');
    Route::get('/application/{id}', 'ApplicationController@choose');
    Route::post('/application/{id}/accept', 'ApplicationController@accept');
    Route::post('/application/{id}/cancel', 'ApplicationController@cancel');
    Route::post('/application/{id}/deal', 'ApplicationController@deal');
    Route::post('/application/{id}/canAccept', 'ApplicationController@canAccept');


    //  get address
    Route::get('/getCity', [
        'uses'=>'AreaController@getCity'
    ]);
    Route::get('/getDistrict/{id}', [
        'uses'=>'AreaController@getDistrict'
    ]);
    Route::get('/getProvince/{id}', [
        'uses'=>'AreaController@getProvince'
    ]);

    //  user
    Route::get('/profile', 'UserController@profile');

    //review
    Route::post('/review', 'ReviewController@store');


});

