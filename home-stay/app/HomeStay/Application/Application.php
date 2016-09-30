<?php

namespace App\HomeStay\Application;

use App\HomeStay\Apartment\Apartment;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Application
 * @package App\HomeStay\Application
 */
class Application extends Model
{
    /**
     * @param User $applicant
     * @return static
     */
    public function setApplicant(User $applicant)
    {
        $this->setAttribute('user_id', $applicant->getId());

        return $this;
    }

    /**
     * @param Apartment $apartment
     * @return self
     */
    public function setApartment(Apartment $apartment)
    {
        $this->setAttribute('apartment_id', $apartment->getId());

        return $this;
    }

    /**
     *
     */
    public function getApartmentId()
    {
        $this->getAttribute('apartment_id');
    }

    /**
     * @param string $state
     * @return self
     */
    public function setState($state)
    {
        $this->setAttribute('state', $state);

        return $this;
    }
}