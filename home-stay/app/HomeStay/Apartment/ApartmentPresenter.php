<?php

namespace App\HomeStay\Apartment;


use Illuminate\Contracts\Support\Arrayable;

class ApartmentPresenter implements Arrayable
{
    public function present(Apartment $apartment, $reviewList, $owner)
    {

    }


    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}