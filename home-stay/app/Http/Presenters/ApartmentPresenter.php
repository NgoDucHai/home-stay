<?php

namespace App\Http\Presenters;

use App\HomeStay\Apartment\Apartment;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;

/**
 * Class ApartmentPresenter
 * @package App\Http\Presenters
 */
class ApartmentPresenter implements Jsonable
{
    protected $apartment;

    public function __construct(Apartment $apartment)
    {
        $this->apartment = $apartment;
    }

    public function toJson($options = 0)
    {

        return json_encode([
            'id'            => $this->apartment->getId(),
            'owner' => $this->apartment->getOwner()->getAttributes(),
            'description' => $this->apartment->getDescription(),
            'name'          => $this->apartment->getName(),
            'price'         => $this->apartment->getPrice(),
            'images'        => $this->apartment->getImages(),
            'availabilities' => [
                'from' => $this->apartment->getAvailabilities()[0]->getTimestamp(),
                'to' => $this->apartment->getAvailabilities()[1]->getTimestamp(),
            ],
            'capacities' => [
                'from' => $this->apartment->getCapacity()[0],
                'to' => $this->apartment->getCapacity()[1],
            ],
            'location' => $this->apartment->getLocation()->toArray(),
            'city'      => $this->apartment->getCity(),
            'district'  => $this->apartment->getDistrict(),
            'province'  => $this->apartment->getProvince(),
            'review'    => $this->apartment->getReviews()

        ], $options);
    }

    public function jsonList($rawApartments)
    {
        return new Collection(array_map(
            function ($rawApartment) {
                return $this->toJson($rawApartment) ;
            }, $rawApartments));
    }
}