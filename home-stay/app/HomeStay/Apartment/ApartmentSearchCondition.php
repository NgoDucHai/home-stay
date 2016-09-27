<?php

namespace App\HomeStay\Apartment;


use Illuminate\Database\Query\Builder;

interface ApartmentSearchCondition
{
    /**
     * @param Builder $query
     */
    public function decorateQuery(Builder $query);
}