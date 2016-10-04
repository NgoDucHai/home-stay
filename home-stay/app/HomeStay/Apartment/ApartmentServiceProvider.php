<?php

namespace App\HomeStay\Apartment;

use DB;
use App\HomeStay\Apartment\ApartmentStorageEngine\MySqlEngine;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\MySqlConnection;
use Illuminate\Support\ServiceProvider;

/**
 * Class ApartmentServiceProvider
 * @package App\HomeStay\Apartment
 */
class ApartmentServiceProvider extends ServiceProvider
{

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->app->singleton(ApartmentRepository::class, function () {
            $connection   = DB::connection();
            if ( ! $connection instanceof MySqlConnection) {
                throw new BindingResolutionException('Current configuration is not mysql engine');
            }

            return new ApartmentRepository(new MySqlEngine($connection), new ApartmentFactory());
        });
    }
}