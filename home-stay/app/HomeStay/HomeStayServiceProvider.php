<?php

namespace App\HomeStay;

use App\HomeStay\Apartment\ApartmentFactory;
use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Apartment\ApartmentStorageEngine\MySqlEngine;
use App\HomeStay\Application\ApplicationWorkFlow;
use App\HomeStay\Policies\UserOwnApartmentPolicy;
use App\HomeStay\ReviewingService\ReviewingService;
use DB;
use Illuminate\Database\MySqlConnection;
use Illuminate\Support\ServiceProvider;

/**
 * Class HomeStayServiceProvider
 * @package App\HomeStay
 */

class HomeStayServiceProvider extends ServiceProvider
{
    protected $defer = true;
    protected $mysqlEngine;
    protected $connection;
    protected $mySqlConnection;

    public function register()
    {
        /**
         * return ApartmentRepository
         */
        $this->connection   = DB::connection();
        $this->mySqlConnection   = new MySqlConnection::$this->connection;
        $this->mysqlEngine  = new MySqlEngine($this->mySqlConnection );
        $this->app->singleton(
            ApartmentRepository::class, function ()
        {
            return new ApartmentRepository($this->mysqlEngine , new ApartmentFactory());
        });

        $this->app->singleton(ReviewingService::class, function ()
        {
            return new ReviewingService($this->connection);
        });

        $this->app->singleton(ApplicationWorkFlow::class, function ()
        {
           return new ApplicationWorkFlow(new UserOwnApartmentPolicy($this->connection));
        });
    }
}