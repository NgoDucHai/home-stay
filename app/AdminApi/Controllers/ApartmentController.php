<?php

namespace App\AdminApi\Controllers;


use App\AdminApi\Entities\Apartment;

class ApartmentController extends RestController
{
    protected function getModelClass()
    {
        return Apartment::class;
    }

}