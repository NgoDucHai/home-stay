<?php

namespace App\HomeStay\Application;


use App\HomeStay\Apartment\Apartment;
use App\User;
class ApplicationWorkFlow
{
    public function __construct()
    {

    }

    /**
     * @param User $user
     * @param Apartment $apartment
     * @return Application
     */
    public function make(User $user, Apartment $apartment)
    {
        return new Application();
    }

    public function accept(Application $application)
    {
        
    }

    public function cancel(Application $application)
    {
        
    }

    public function deal(Application $application)
    {

    }

    /**
     * @param User $user
     *
     * @return boolean
     */
    public function canAccept(User $user)
    {

    }
}