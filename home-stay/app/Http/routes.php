<?php


use App\Http\Middleware\searchApartmentMiddleware;
use App\Http\Middleware\storeApartmentMiddleware;

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('index');
    });

    Route::get('/apartments', 'ApartmentController@index');

    Route::get('/apartment/{id}', 'ApartmentController@read');

    Route::post('/apartment',[
        'middleware' => storeApartmentMiddleware::class,
        'uses'       => 'ApartmentController@store'
    ]);

    Route::get('/apartment/{id}/edit', 'ApartmentController@edit');

    Route::delete('/apartment/{id}', 'ApartmentController@destroy');

    Route::get('/search', [
        'middleware' => searchApartmentMiddleware::class,
        'uses'       => 'ApartmentController@search'
    ]);


    Route::get('/', [
        'uses'=>'AreaController@getCity'
    ]);
    Route::get('/getDistrict/{id}', [
        'uses'=>'AreaController@getDistrict'
    ]);
    Route::get('/getProvince/{id}', [
        'uses'=>'AreaController@getProvince'
    ]);

});
