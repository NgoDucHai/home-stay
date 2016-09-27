<?php

namespace App\HomeStay\Apartment;

/**
 * Class Area
 * @package App\HomeStay\Apartment
 */
class Area
{
    /**
     * Area constructor.
     * @param string $city
     */
    public function __construct($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $district
     * @return $this
     */
    public function setDistrict($district)
    {

        return $this;
    }

    /**
     * @param string $street
     * @return $this
     */
    public function setStreet($street)
    {

        return $this;
    }
}