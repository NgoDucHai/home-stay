<?php



Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/add/{number1}/{number2}', 'Home@add');
    Route::get('/pow/{number1}/{number2}', 'Home@pow');


});
