<?php

namespace App\HomeStay\Apartment;


use Illuminate\Database\Query\Builder;

/**
 * Class ApartmentAreaSearchCondition
 * @package App\HomeStay\Apartment
 */
class ApartmentAreaSearchCondition implements ApartmentSearchCondition
{
    /**
     * @var int
     */
    private $capacityFrom;
    /**
     * @var int
     */
    private $capacityTo;

    /**
     * @var \DateTime
     */
    private $availableFrom;

    /**
     * @var \DateTime
     */
    private $availableTo;

    /**
     * @var Area
     */
    private $city;

    /**
     * @param \DateTime|null $from
     * @param \DateTime|null $to
     * @return $this
     */
    public function availableIn(\DateTime $from = null, \DateTime $to = null)
    {
        $this->availableFrom = $from;
        $this->availableTo   = $to;

        return $this;
    }

    /**
     * @param null $from
     * @param null $to
     * @return $this
     */
    public function hasCapacityFrom($from = null, $to = null)
    {
        $this->capacityFrom = $from;
        $this->capacityTo   = $to;

        return $this;
    }

    /**
     * @param Area $city
     */
    public function in(Area $city)
    {
        $this->city = $city->city;
    }

    /**
     * @inheritdoc
     * @param Builder $query
     */
    public function decorateQuery(Builder $query)
    {
        if ($this->availableFrom) {
            $query->where('available_from', '<', $this->availableFrom->format('Y-m-d H:i:s'));
        }

        if ($this->availableTo) {
            $query->where('available_to', '>', $this->availableTo->format('Y-m-d H:i:s'));
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
