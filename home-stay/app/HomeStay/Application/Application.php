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
     * Application constructor.
     * @param User $applicatant
     * @param Apartment $apartment
     * @param string $state
     */
    public function __construct(User $applicatant, Apartment $apartment, $state = ApplicationState::PENDING)
    {
        $this->applicatant = $applicatant;
        $this->apartment = $apartment;
        $this->state = $state;
    }
}