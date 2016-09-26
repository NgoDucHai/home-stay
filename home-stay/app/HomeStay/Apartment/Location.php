<?php

namespace App\HomeStay\Apartment;


use Illuminate\Contracts\Support\Arrayable;

class Location implements Arrayable
{
    protected $lat;

    protected $lng;

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
}