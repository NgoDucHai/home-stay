<?php

namespace App\AdminApi;


use Illuminate\Support\ServiceProvider;

class AdminApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Route::group(['prefix' => '/admin'], function () {
            \Route::get('/apartment', 'App\AdminApi\Controllers\ApartmentController@get');
        });
    }

    public function register()
    {
        // TODO: Implement register() method.
    }
}