<?php

namespace App\HomeStay\Apartment;

use App\UserFactory;
use Illuminate\Support\Collection;

/**
 * Class ApartmentRepository
 * @package App\HomeStay\Apartment
 */
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

        return new Collection(array_map(
            function ($rawApartment) {
            $rawOwner = \DB::table('users')->where('id', '=', $rawApartment->user_id)->get();
            $userFactory = new UserFactory();
            $owner = $userFactory->factory($rawOwner);
            $apartment = new Apartment(new Location($rawApartment->lat, $rawApartment->lng), $owner );

            return $apartment
                ->setId($rawApartment->id)
                ->setCapacity($rawApartment->capacity_from, $rawApartment->capacity_to)
                ->setCity($rawApartment->city)
            ;
        }, $rawApartments));
    }

    /**
     * @param $id
     * @return Apartment
     */
    public function get($id)
    {
        $rawApartment = \DB::table('apartments')->find($id, array_merge(['*'], Location::toSelectFields('location')));

        $rawOwner = \DB::table('users')->where('id', '=', $rawApartment->user_id)->get();
        $userFactory = new UserFactory();
        $owner = $userFactory->factory($rawOwner);
        $apartment = new Apartment(new Location($rawApartment->lat, $rawApartment->lng), $owner );

        return $apartment
            ->setId($rawApartment->id)
            ->setCapacity($rawApartment->capacity_from, $rawApartment->capacity_to)
            ->setCity($rawApartment->city)
            ;
    }
}
