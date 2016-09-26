<?php

namespace App\HomeStay\Apartment;

/**
 * Class Apartment
 * @package App\HomeStay\Apartment
 */
class Apartment
{
    /**
     * @var Location
     */
    protected $location;

    /**
     * Apartment constructor.
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     *
     */
    public function reviews()
    {

    }

    /**
     *
     */
    public function owner()
    {

    }
}