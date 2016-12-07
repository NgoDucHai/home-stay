<?php

namespace App\AdminApi;

use Illuminate\Support\ServiceProvider;

class AdminApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /** @var RouterDecorator $decorator */
        $decorator = $this->app->make('admin.route-decorator');

        \Route::group(['prefix' => '/' . config('admin.prefix'), 'middleware' => ['web', 'cors']], function () use ($decorator) {
            $decorator->decorate(config('admin.resources'));
        });
    }

    public function register()
    {
        $this->app->singleton('admin.route-decorator', function () {
            return new RouterDecorator($this->app->make('router'));
        });
    }
}