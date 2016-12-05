<?php

namespace App\HomeStay\Apartment;

use App\EarthGeometry\Earth;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * Class ApartmentNearbySearchCondition
 * @package App\HomeStay\Apartment
 */
class ApartmentNearbySearchCondition implements ApartmentSearchCondition
{
    protected $capacity;
    /**
     * @var Location
     */
    private $center;

    /**
     * @var integer
     */
    private $radius;

    /**
     * @var \DateTime
     */
    private $availableTo;

    /**
     * @var \DateTime
     */
    private $availableFrom;

    /**
     * ApartmentNearbySearchCondition constructor.
     *
     * @param Location $center
     * @param integer $radius
     */
    public function __construct(Location $center, $radius)
    {
        $this->center = $center;
        $this->radius = $radius;
    }

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return self
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
     * @inheritdoc
     * @param $query Builder
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
        $boundary = Earth::boundary($this->center->lat(), $this->center->lng(), $this->radius);

        $query
            ->where($query->getConnection()->raw('X(location)'), '>', $boundary['minLat'])
            ->where($query->getConnection()->raw('X(location)'), '<', $boundary['maxLat'])
            ->where($query->getConnection()->raw('Y(location)'), '>', $boundary['minLng'])
            ->where($query->getConnection()->raw('Y(location)'), '<', $boundary['maxLng'])
        ;
    }

    /**
     * @param Apartment[] $result
     * @return Apartment[]|Collection
     */
    public function refineResult($result)
    {
        if ($result instanceof Collection) {
            return $result->filter(function (Apartment $apartment)
            {
                return Earth::haversineDistance(
                    $this->center->lat(),
                    $this->center->lng(),
                    $apartment->getLocation()->lat(),
                    $apartment->getLocation()->lng()
                ) <= $this->radius;
            });
        } else {
            return array_filter($result, function (Apartment $apartment)
            {
                return Earth::haversineDistance(
                    $this->center->lat(),
                    $this->center->lng(),
                    $apartment->getLocation()->lat(),
                    $apartment->getLocation()->lng()
                ) <= $this->radius;
            });
        }

    }


}