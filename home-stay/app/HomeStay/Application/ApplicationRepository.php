<?php

namespace App\HomeStay\Application;


use App\HomeStay\Apartment\ApartmentRepository;
use App\User;

class ApplicationRepository
{
    /**
     * @param Application $application
     */
    public function create(Application $application)
    {
        $reader = new  ApplicationReader();
        $rawApplication = $reader->read($application);

        \DB::table('applications')->insert([$rawApplication]);
    }

    /**
     * @param $id
     * @return Application
     */
    public function get($id)
    {
        $rawApplication  = \DB::table('applications')->find($id);


        /** @var User $applicant */
        $applicant       = User::find($rawApplication->user_id);

        $apartmentRepo = new ApartmentRepository();
        $apartment       = $apartmentRepo->get($rawApplication->apartment_id);

        /** @var Application $application */
        $application = new Application($applicant, $apartment, $rawApplication->state);
        $application->setId($rawApplication->id);

        return $application;
    }

    /**
     * @param Application $application
     */
    public function updateState(Application $application){
        \DB::table('applications')
            ->where('id',$application->getId())
            ->update(['state' => $application->getState()]);
    }

}