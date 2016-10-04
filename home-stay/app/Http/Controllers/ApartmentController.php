<?php

namespace App\Http\Controllers;

use App\HomeStay\Apartment\ApartmentRepository;
use App\Http\Presenters\ApartmentPresenter;

class ApartmentController extends Controller 
{
    protected $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    public function index($id)
    {
        $apartment = $this->apartmentRepository->get($id);

        if ( ! $apartment)
        {
            return \Response::json([
                'error' => 'E_NOT_FOUND',
                'message' => "No apartments with id [$id] was found"
            ], 404);
        }

        return new ApartmentPresenter($apartment);
    }

}
