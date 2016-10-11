<?php

namespace App\HomeStay\Apartment;

/**
 * Class Area
 * @package App\HomeStay\Apartment
 */
class Area
{
    /**
     * @var int $district
     */
    public $district;
    /**
     * @var int $province
     */
    public $province;

    /**
     * Area constructor.
     * @param int $city
     */
    public function __construct($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param int $district
     * @return $this
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @param int $province
     * @return $this
     */
    public function setProvince($province)
    {
        $this->province = $province;
        return $this;
    }
}