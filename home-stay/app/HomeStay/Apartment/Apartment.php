<?php

namespace App\HomeStay\Apartment;

/**
 * Class Apartmenta
 * @package App\HomeStay\Apartment
 */
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
     * @var \DateTime
     */
    private $availableFrom;

    /**
     * @var \DateTime
     */
    private $availableTo;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $district;
    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string[]
     */
    private $images;

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
     * @return Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param Collection $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param string[] $images
     * @return self
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param int $from
     * @param int $to
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
     * @param int $id
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
        return intval($this->id);
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

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return self
     */
    public function setAvailabilities(\DateTime $from = null, \DateTime $to = null)
    {
        $this->availableFrom    = $from;
        $this->availableTo      = $to;
        return $this;
    }
    /**
     * @return \DateTime[]
     */
    public function getAvailabilities()
    {
        return [
            $this->availableFrom,
            $this->availableTo
        ];
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param string $district
     * @return self
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param string $province
     * @return self
     */
    public function setProvince($province)
    {
        $this->province = $province;
        return $this;
    }
}
