<?php

namespace App\HomeStay\ReviewingService;

use DB;
use Illuminate\Support\ServiceProvider;

/**
 * Class ReviewingServiceProvider
 * @package App\HomeStay\ReviewingService
 */
class ReviewingServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->app->singleton(ReviewingService::class, function ()
        {
            return new ReviewingService(DB::connection(), new ReviewFactory());
        });
    }
}
