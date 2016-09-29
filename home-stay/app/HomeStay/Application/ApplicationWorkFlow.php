<?php

namespace App\HomeStay\Application;

use App\HomeStay\Apartment\Apartment;
use App\User;

/**
 * Class ApplicationWorkFlow
 * @package App\HomeStay\Application
 */
class ApplicationWorkFlow
{
    /**
     * @param User $user
     * @param Apartment $apartment
     * @return Application
     */

    public function make(User $user, Apartment $apartment)
    {
        $application = new Application($user, $apartment);
        $applicationRepo = new ApplicationRepository();
        $applicationRepo->create($application);
        return $application;
    }

    /**
     * @param Application $application
     * @return Application
     */
    public function accept(Application $application)
    {
        $state = ApplicationState::ACCEPTED;
        /** @var ApplicationState $state */
        $application->setState($state);
        $this->updateState($application);
        return $application;
    }

    /**
     * @param Application $application
     * @return Application
     */
    public function cancel(Application $application)
    {
        $state = ApplicationState::CANCELLED;
        /** @var ApplicationState $state */
        $application->setState($state);
        $this->updateState($application);
        return $application;

    }

    /**
     * @param Application $application
     * @return Application
     */
    public function deal(Application $application)
    {
        $state = ApplicationState::DEAL;
        /** @var ApplicationState $state */
        $application->setState($state);
        $this->updateState($application);
        return $application;
    }

    public function canAccept()
    {
    }

    public function updateState(Application $application)
    {
        $applicationRepo = new ApplicationRepository();
        $applicationRepo->updateState($application);
    }


}