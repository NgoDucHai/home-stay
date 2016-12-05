<?php

namespace App\HomeStay\Application;

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Policies\UserOwnApartmentPolicy;
use App\User;
use DB;

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
     * @param $userId
     * @param $apartmentId
     * @param $message
     * @return Application $application
     */
    public function make($userId, $apartmentId, $message)
    {
        return with(new Application())
            ->setApplicantId($userId)
            ->setApartmentId($apartmentId)
            ->setState(ApplicationState::PENDING)
            ->setMessage($message)
        ;
    }

    /**
     * @param Application $application
     */
    public function update(Application $application){
        DB::table('applications')
            ->where('id', $application->id)
            ->update(['state' =>$application->state]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getApplicationById($id)
    {
        return DB::table('applications')->where('id', $id)->first();
    }

    /**
     * @param $id
     * @return array|static[]
     */
    public function getListApplicationByApartmentId($id)
    {
        return DB::table('applications')->where('apartment_id', $id)->get();
    }

    /**
     * @param $id
     * @return array|static[]
     */
    public function getListApplicationByUserId($id)
    {
        return DB::table('applications')->where('user_id', $id)->get();
    }

    public function getListApplicationByOwnerId($id)
    {
        $apartments = DB::table('apartments')->where('user_id', $id)->get();
    }

    /**
     * @param User $performer
     * @param Application $application
     * @throws UnSatisfyApplicationWorkflowException
     */
    public function accept(User $performer, Application $application)
    {
//        if ( ! $this->canAccept($performer, $application))
//        {
//            throw new UnSatisfyApplicationWorkflowException(
//                'User must own the apartment to perform accept action'
//            );
//        }
        $application->setState(ApplicationState::ACCEPTED);
        $this->update($application);
    }

    /**
     * @param Application $application
     */
    public function cancel(Application $application)
    {
        $application->setState(ApplicationState::CANCELLED);
        $this->update($application);
    }

    /**
     * @param Application $application
     */
    public function deal(Application $application)
    {
        $application->setState(ApplicationState::DEAL);
        $this->update($application);
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
