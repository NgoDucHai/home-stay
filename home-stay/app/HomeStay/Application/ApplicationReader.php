<?php

namespace App\HomeStay\Application;


class ApplicationReader
{
    public function read(Application $application)
    {
        return [
            'user_id'       => $application->getApplicatant()->getId(),
            'apartment_id'  => $application->getApartment()->getId(),
            'state'         => $application->getState()
        ];
    }
}