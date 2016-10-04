<?php

namespace App\HomeStay\Apartment;

use App\User;
use Carbon\Carbon;
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
        $owner = User::findOrFail($rawApartment->user_id);
        /** @var User $owner */
        $apartment = new Apartment(new Location($rawApartment->lat, $rawApartment->lng), $owner);
        return $apartment
            ->setId(intval($rawApartment->id))
            ->setCapacity(intval($rawApartment->capacity_from), intval($rawApartment->capacity_to))
            ->setAvailabilities(Carbon::createFromFormat('Y-m-d H:i:s', $rawApartment->available_from), Carbon::createFromFormat('Y-m-d H:i:s', $rawApartment->available_to))
            ->setCity($rawApartment->city)
            ->setName($rawApartment->name)
            ->setDescription($rawApartment->description)
            ->setImages(json_decode($rawApartment->images))
            ->setPrice(floatval($rawApartment->price))
        ;
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
