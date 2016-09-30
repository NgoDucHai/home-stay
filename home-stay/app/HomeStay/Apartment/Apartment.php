<?php

namespace App\HomeStay\Apartment;

/**
 * Class Apartment
 * @package App\HomeStay\Apartment
 */
use App\User;
use Illuminate\Support\Collection;

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
     * @var Collection
     */
    protected $reviews;

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
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
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
     * @return int[]
     */
    public function getCapacity()
    {
        return [
            $this->capacityFrom,
            $this->capacityTo
        ];
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

    /**
     * @param Collection $reviews
     */
    public function setLatestReviews(Collection $reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return Collection
     */
    public function getLatestReviews()
    {
        return $this->reviews;
    }
}