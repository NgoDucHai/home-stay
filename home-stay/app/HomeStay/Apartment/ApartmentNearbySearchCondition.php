<?php

namespace App\HomeStay\Apartment;

use App\EarthGeometry\Earth;
use Illuminate\Database\Query\Builder;

/**
 * Class ApartmentNearbySearchCondition
 * @package App\HomeStay\Apartment
 */
class ApartmentNearbySearchCondition implements ApartmentSearchCondition
{
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
    private $availabelTo;

    /**
     * @var \DateTime
     */
    private $availabelFrom;

    /**
     * @var integer
     */
    private $capacityFrom;

    /**
     * @var integer
     */
    private $capacityTo;

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
        $this->availabelFrom = $from;
        $this->availabelTo   = $to;

        return $this;
    }

    /**
     * @param integer $from
     * @param integer $to
     * @return self
     */
    public function hasCapacityFrom($from = null, $to = null)
    {
        $this->capacityFrom = $from;
        $this->capacityTo   = $to;

        return $this;
    }

    /**
     * @param $query Builder
     */
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
        $boundary = Earth::boundary($this->center->lat(), $this->center->lng(), $this->radius);
        $query
            ->where($query->getConnection()->raw('X(location)'), '>', $boundary['minLat'])
            ->where($query->getConnection()->raw('X(location)'), '<', $boundary['maxLat'])
            ->where($query->getConnection()->raw('Y(location)'), '>', $boundary['minLng'])
            ->where($query->getConnection()->raw('Y(location)'), '<', $boundary['maxLng'])
        ;
    }
}