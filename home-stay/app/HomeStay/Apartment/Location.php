<?php

namespace App\HomeStay\Apartment;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class Location
 * @package App\HomeStay\Apartment
 */
class Location implements Arrayable
{
    /**
     * @var float
     */
    protected $lat;

    /**
     * @var float
     */
    protected $lng;

    /**
     * Location constructor.
     * @param $lat
     * @param $lng
     */
    public function __construct($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [$this->lat, $this->lng];
    }


    /**
     * @return float
     */
    public function lat()
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function lng()
    {
        return $this->lng;
    }
}
