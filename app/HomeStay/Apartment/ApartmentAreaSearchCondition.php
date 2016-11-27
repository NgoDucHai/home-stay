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
    private $capacity;

    /**
     * @var \DateTime
     */
    private $availableFrom;

    /**
     * @var \DateTime
     */
    private $availableTo;

    /**
     * @var int
     */
    private $city;

    /**
     * @var int
     */
    private $district;
    /**
     * @var int
     */
    private $province;

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
     * @param null $capacity
     * @return static
     */
    public function hasCapacity($capacity = null)
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @param Area $area
     * @return self
     */
    public function in(Area $area)
    {
        $this->city = $area->city;
        $this->district = $area->district ? $area->district : null;
        $this->province = $area->province ? $area->province : null;
        return $this;
    }

    /**
     * @inheritdoc
     * @param Builder $query
     */
    public function decorateQuery(Builder $query)
    {
        if ($this->availableFrom) {
            $query->where('available_from', '<=', $this->availableFrom->format('Y-m-d H:i:s'));
        }

        if ($this->availableTo) {
            $query->where('available_to', '>=', $this->availableTo->format('Y-m-d H:i:s'));
        }

        if ($this->capacity) {
            $query->where('capacity_from', '<=', $this->capacity);
        }

        if ($this->capacity) {
            $query->where('capacity_to', '>=', $this->capacity);
        }

        if( $this->city){
            $query->where('city', '=', $this->city);
        }

        if ( $this->district){
            $query->where('district', '=', $this->district);
        }

        if ( $this->province){
            $query->where('province', '=', $this->province);
        }
    }
}
