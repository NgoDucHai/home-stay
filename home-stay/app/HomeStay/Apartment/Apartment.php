<?php

namespace App\HomeStay\Apartment;

/**
 * Class Apartment
 * @package App\HomeStay\Apartment
 */
use App\HomeStay\ReviewingService\ReviewingService;
use App\User;

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
     * @var User
     *
     */
    protected $owner;

    /**
     * Apartment constructor.
     * @param Location $location
     * @param User $owner
     */
    public function __construct(Location $location, User $owner)
    {
        $this->location = $location;
        $this->owner    = $owner;
    }

    /**
     *
     */
    public function reviews()
    {

    }


    /**
     * @param null $from
     * @param null $to
     * @return self
     */
    public function setCapacity($from = null, $to = null)
    {
        $this->capacityFrom = $from;
        $this->capacityTo   = $to;

        return $this;
    }

    /**
     * @return int
     */
    public function getCapacityFrom()
    {
        return $this->capacityFrom;
    }

    /**
     * @return int
     */
    public function getCapacityTo()
    {
        return $this->capacityTo;
    }

    /**
     * @param $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param $city
     * @return self
     */
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

    public function getReviewsList()
    {
        $reviewingService = new ReviewingService();
        $reviewList = $reviewingService->getReviewByApartmentId($this->getId());

        return $reviewList;
    }
}