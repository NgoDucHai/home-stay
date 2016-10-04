<?php

namespace App\HomeStay\Application;

use DB;
use App\HomeStay\Policies\UserOwnApartmentPolicy;
use Illuminate\Support\ServiceProvider;

/**
 * Class ApplicationWorkFlowServiceProvider
 * @package App\HomeStay\Application
 */
class ApplicationWorkFlowServiceProvider extends ServiceProvider
{

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->app->singleton(ApplicationWorkFlow::class, function ()
        {
            return new ApplicationWorkFlow(new UserOwnApartmentPolicy(DB::connection()));
        });
    }
}
