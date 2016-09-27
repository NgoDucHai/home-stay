<?php

namespace App\HomeStay\Apartment;

/**
 * Class Apartment
 * @package App\HomeStay\Apartment
 */
class Apartment
{
    /**
     * @var Location
     */
    protected $location;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $capacityFrom;

    /**
     * @var integer
     */
    private $capacityTo;

    /**
     * @var string
     */
    private $city;

    /**
     * Apartment constructor.
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $this->location = $location;

    }

    /**
     *
     */
    public function reviews()
    {

    }

    /**
     *
     */
    public function owner()
    {

    }

    public function setCapacity($from = null, $to = null)
    {
        $this->capacityFrom = $from;
        $this->capacityTo   = $to;

        return $this;
    }

    public function getCapacityFrom()
    {
        return $this->capacityFrom;
    }

    public function getCapacityTo()
    {
        return $this->capacityTo;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}