<?php

namespace App\HomeStay\Application;

use App\HomeStay\Apartment\Apartment;
use App\User;

/**
 * Class ApplicationWorkFlow
 * @package App\HomeStay\Application
 */
class ApplicationWorkFlow
{
    /**
     * @param User $user
     * @param Apartment $apartment
     */
    public function make(User $user, Apartment $apartment)
    {
    }

    /**
     * @param Application $application
     * @return Application
     */
    public function accept(Application $application)
    {
        
    }

    /**
     * @param Application $application
     * @return Application
     */
    public function cancel(Application $application)
    {
        
    }

    /**
     * @param Application $application
     * @return Application
     */
    public function deal(Application $application)
    {

    }

    /**
     * @param User $user
     * @return bool
     */
    public function canAccept(User $user)
    {

    }
}