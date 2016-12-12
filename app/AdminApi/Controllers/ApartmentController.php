<?php

namespace App\AdminApi\Controllers;

use App\AdminApi\Entities\Apartment;

/**
 * Class ApartmentController
 * @package App\AdminApi\Controllers
 */
class ApartmentController extends RestController
{
    public function __construct()
    {
        $this->middleware('updateApartment')->only('update');
    }
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Apartment::class;
    }
}
