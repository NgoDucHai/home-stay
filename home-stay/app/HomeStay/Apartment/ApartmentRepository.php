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
        $query = \DB::table('apartments');
        $condition->decorateQuery($query);

        $rawApartments = $query->get(array_merge(['*'], Location::toSelectFields('location')));


        return new Collection(array_map(function ($rawApartment) {
            $apartment = new Apartment(new Location($rawApartment->lat, $rawApartment->lng));

            return $apartment
                ->setId($rawApartment->id)
                ->setCapacity($rawApartment->capacity_from, $rawApartment->capacity_to)
                ->setCity($rawApartment->city)
            ;
        }, $rawApartments));
    }

    public function get($id)
    {
        $rawApartment = \DB::table('apartments')->find($id, array_merge(['*'], Location::toSelectFields('location')));

        $apartment = new Apartment(new Location($rawApartment->lat, $rawApartment->lng));

        return $apartment
            ->setId($rawApartment->id)
            ->setCapacity($rawApartment->capacity_from, $rawApartment->capacity_to)
            ->setCity($rawApartment->city)
            ;
    }
}
