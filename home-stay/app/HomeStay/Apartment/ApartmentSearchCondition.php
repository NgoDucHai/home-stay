<?php

namespace App\HomeStay\Apartment;


interface ApartmentSearchCondition
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function getQuery();
}