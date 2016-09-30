<?php

namespace App\HomeStay\Application;

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Policies\UserOwnApartmentPolicy;
use App\User;

/**
 * Class ApplicationWorkFlow
 * @package App\HomeStay\Application
 */
class ApplicationWorkFlow
{
    /**
     * @var UserOwnApartmentPolicy
     */
    protected $ownApartmentPolicy;

    /**
     * ApplicationWorkFlow constructor.
     * @param UserOwnApartmentPolicy $ownApartmentPolicy
     */
    public function __construct(UserOwnApartmentPolicy $ownApartmentPolicy)
    {
        $this->ownApartmentPolicy = $ownApartmentPolicy;
    }

    /**
     * @param User $user
     * @param Apartment $apartment
     * @return Application
     */
    public function make(User $user, Apartment $apartment)
    {
        return with(new Application())
            ->setApplicant($user)
            ->setApartment($apartment)
            ->setState(ApplicationState::PENDING)
        ;
    }

    /**
     * @param User $performer
     * @param Application $application
     * @throws UnSatisfyApplicationWorkflowException
     */
    public function accept(User $performer, Application $application)
    {
        if ( ! $this->canAccept($performer, $application))
        {
            throw new UnSatisfyApplicationWorkflowException(
                'User must own the apartment to perform accept action'
            );
        }

        $application
            ->setState(ApplicationState::ACCEPTED)
            ->save()
        ;
    }

    /**
     * @param Application $application
     */
    public function cancel(Application $application)
    {
        $application
            ->setState(ApplicationState::CANCELLED)
            ->save()
        ;
    }

    /**
     * @param Application $application
     */
    public function deal(Application $application)
    {
        $application
            ->setState(ApplicationState::DEAL)
            ->save()
        ;
    }

    /**
     * @param User $performer
     * @param Application $application
     * @return bool
     */
    public function canAccept(User $performer, Application $application)
    {
        return $this->ownApartmentPolicy->check(
            $performer->getId(),
            $application->getApartmentId()
        );
    }
}