<?php

namespace App\HomeStay\Apartment;

use App\HomeStay\GeometryDataType;
use Illuminate\Contracts\Support\Arrayable;

class Location implements Arrayable, GeometryDataType
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

    /**
     * @return \Illuminate\Database\Query\Expression
     */
    public function toSql()
    {
        return \DB::raw("GeomFromText('POINT({$this->lat} {$this->lng})')");
    }
}