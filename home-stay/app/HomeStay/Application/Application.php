<?php

namespace App\HomeStay\Application;

use App\HomeStay\Apartment\Apartment;
use App\User;

/**
 * Class Application
 * @package App\HomeStay\Application
 */
class Application
{
    /**
     * @var User
     */
    private $applicatant;

    /**
     * @var Apartment
     */
    private $apartment;

    /**
     * @var string
     */
    private $state;


    /**
     * @var string
     */
    private $id;
    /**
     * @return User
     */

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getApplicatant()
    {
        return $this->applicatant;
    }

    /**
     * @param User $applicatant
     */
    public function setApplicatant($applicatant)
    {
        $this->applicatant = $applicatant;
    }

    /**
     * @return Apartment
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * @param Apartment $apartment
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
    }

    /**
     * Application constructor.
     * @param User $applicant
     * @param Apartment $apartment
     * @param string $state
     */
    public function __construct(User $applicant, Apartment $apartment, $state = ApplicationState::PENDING)
    {
        $this->applicatant = $applicant;
        $this->apartment = $apartment;
        $this->state = $state;
    }


    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }


}