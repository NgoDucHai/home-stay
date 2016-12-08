<?php


use App\Http\Middleware\searchApartmentMiddleware;
use App\Http\Middleware\searchNearApartmentMiddleware;
use App\Http\Middleware\storeApartmentMiddleware;
use App\Http\Middleware\updateApartmentMiddleware;

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
    Route::get('/apartment/user', 'ApartmentController@getApartmentByUserId');

    Route::get('/apartment/{id}', ['as'=>'apartment.read','uses'=>'ApartmentController@read']);

    Route::post('/apartment',[
        'middleware' => storeApartmentMiddleware::class,
        'uses'       => 'ApartmentController@store'
    ]);

    Route::post('/apartment/{id}/edit',[
        'middleware' => updateApartmentMiddleware::class,
        'uses'       => 'ApartmentController@update'
    ]);

    Route::get('/apartment/{id}/edit', 'ApartmentController@edit');

    Route::delete('/apartment/{id}', 'ApartmentController@destroy');
    //    image

    Route::get('/add', 'ImageController@create');
    Route::post('/dropzone/store', ['as'=>'dropzone.store','uses'=>'ImageController@store']);

    //    search
    Route::get('/search/option', [
        'middleware' => searchApartmentMiddleware::class,
        'uses'       => 'ApartmentController@search'
    ]);

    Route::get('/search/near', [
        'middleware' => searchNearApartmentMiddleware::class,
        'uses'       => 'ApartmentController@searchNear'
    ]);

    // application
    Route::get('/application', 'ApplicationController@get');
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
    Route::get('/profile/{id}', 'UserController@get');
    Route::post('/profile/{id}', 'UserController@update');
    Route::post('/avatar', 'UserController@avatar');
    //review
    Route::post('/review', 'ReviewController@store');


});

