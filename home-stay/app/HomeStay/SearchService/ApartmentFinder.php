<?php

namespace App\HomeStay\SearchService;


class ApartmentFinder
{
    /**
     * @param SearchCondition $condition
     * @return []
     */
    public function find(SearchCondition $condition)
    {
        return $condition->get();
    }
}