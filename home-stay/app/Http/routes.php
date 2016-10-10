<?php


use App\Http\Middleware\storeApartmentMiddleware;

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/apartments', 'ApartmentController@index');

    Route::get('/apartment/{id}', 'ApartmentController@index');

    Route::post('/apartment',[
        'middleware' => storeApartmentMiddleware::class,
        'uses'       => 'ApartmentController@store'
    ]);

    Route::get('/apartment/{id}/edit', 'ApartmentController@edit');

    Route::delete('/apartment/{id}', 'ApartmentController@destroy');



});
