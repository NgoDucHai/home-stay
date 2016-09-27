<?php

namespace App\HomeStay\Apartment;


use Illuminate\Database\Query\Builder;

class ApartmentAreaSearchCondition implements ApartmentSearchCondition
{
    private $availableFrom;
    private $availableTo;
    private $capacityFrom;
    private $capacityTo;

    /**
     * @var \DateTime
     */
    private $availabelFrom;

    /**
     * @var \DateTime
     */
    private $availabelTo;

    /**
     * @var Area
     */
    private $city;


    public function availableIn(\DateTime $from = null, \DateTime $to = null)
    {
        $this->availableFrom = $from;
        $this->availableTo   = $to;

        return $this;
    }

    public function hasCapacityFrom($from = null, $to = null)
    {
        $this->capacityFrom = $from;
        $this->capacityTo   = $to;

        return $this;
    }

    public function in(Area $city)
    {
        $this->city = $city->city;
    }


    public function decorateQuery(Builder $query)
    {
        if ($this->availabelFrom) {
            $query->where('available_from', '<', $this->availabelFrom->format('Y-m-d H:i:s'));
        }

        if ($this->availabelTo) {
            $query->where('available_to', '>', $this->availabelTo->format('Y-m-d H:i:s'));
        }

        if ($this->capacityFrom) {
            $query->where('capacity_from', '<', $this->capacityFrom);
        }

        if ($this->capacityTo) {
            $query->where('capacity_to', '>', $this->capacityTo);
        }

        if( $this->city){
            $query->where('city', 'LIKE', $this->city);
        }
    }
}