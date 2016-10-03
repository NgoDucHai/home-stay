<?php

namespace App\HomeStay\Apartment\ApartmentStorageEngine;

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\Location;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

interface Engine
{
    /**
     * @param Apartment $apartment
     */
    public function save(Apartment $apartment);

    /**
     * @return Builder
     */
    public function buildQuery();

    /**
     * @param Location $location
     * @return Expression
     */
    public function convertLocationToSql(Location $location);
}