<?php

namespace App\HomeStay\Apartment;

use Illuminate\Support\Collection;

class ApartmentRepository
{
    /**
     * @param ApartmentSearchCondition $condition
     * @return Collection
     */
    public function find(ApartmentSearchCondition $condition)
    {
        return new Collection(array_map(function ($rawApartment) {
            $apartment = new Apartment(new Location($rawApartment->lat, $rawApartment->lng));

            return $apartment
                ->setId($rawApartment->id)
                ->setCapacity($rawApartment->capacity_from, $rawApartment->capacity_to)
                ->setCity($rawApartment->city)
            ;
        }, $condition->getQuery()->get()));
    }
}
