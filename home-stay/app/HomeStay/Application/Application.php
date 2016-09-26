<?php

namespace App\HomeStay\Application;


use App\HomeStay\Apartment\Apartment;
use App\User;

class Application
{
    /**
     * @var Apartment
     */
    protected $apartment;
    /**
     * @var User
     */
    protected $applier;

    /**
     * @return Apartment
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * @param Apartment $apartment
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
    }

    /**
     * @return User
     */
    public function getApplier()
    {
        return $this->applier;
    }

    /**
     * @param User $applier
     */
    public function setApplier($applier)
    {
        $this->applier = $applier;
    }



}