<?php

namespace App\Http\Presenters;

use App\HomeStay\Apartment\Apartment;
use Illuminate\Contracts\Support\Jsonable;

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
            'owner' => $this->apartment->getOwner()->toArray(),
            'availabilities' => [
                'from' => $this->apartment->getAvailabilities()[0]->getTimestamp(),
                'to' => $this->apartment->getAvailabilities()[0]->getTimestamp(),
            ],
            'capacities' => [
                'from' => $this->apartment->getCapacity()[0],
                'to' => $this->apartment->getCapacity()[1],
            ],
            'location' => $this->apartment->getLocation()->toArray(),
            'city'      => $this->apartment->getCity()

        ], $options);
    }
}