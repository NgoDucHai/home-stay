<?php

namespace App\HomeStay\Apartment;

use Illuminate\Database\Query\Builder;

/**
 * Represents some search condition to get the apartments
 *
 * Interface ApartmentSearchCondition
 * @package App\HomeStay\Apartment
 */
interface ApartmentSearchCondition
{
    /**
     * Build the SQL Query with appropriate condition
     *
     * @param Builder $query
     */
    public function decorateQuery(Builder $query);
}
