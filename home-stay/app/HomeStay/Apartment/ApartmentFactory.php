<?php

namespace App\HomeStay\Apartment;

use App\User;
use Illuminate\Support\Collection;

/**
 * Class ApartmentFactory
 * @package App\HomeStay\Apartment
 */
class ApartmentFactory
{
    /**
     * @param $rawApartment
     * @return Apartment
     */
    public function factory($rawApartment)
    {
        $owner = User::findOrFail($rawApartment['user_id']);
        /** @var User $owner */
        $apartment = new Apartment(new Location($rawApartment->lat, $rawApartment->lng), $owner);
        return $apartment
            ->setId($rawApartment->id)
            ->setCapacity($rawApartment->capacity_from, $rawApartment->capacity_to)
            ->setCity($rawApartment->city);
    }

    /**
     * @param $rawApartments
     * @return Collection
     */
    public function factoryList($rawApartments)
    {
        return new Collection(array_map(
            function ($rawApartment) {
                return $this->factory($rawApartment) ;
            }, $rawApartments));
    }
}
