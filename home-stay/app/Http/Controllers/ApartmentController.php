<?php

namespace App\Http\Controllers;


use App\HomeStay\Apartment\ApartmentRepository;
use App\Http\Requests\Request;

class ApartmentController extends Controller 
{
    protected $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository){
        $this->apartmentRepository = $apartmentRepository;    
    }

    public function index(){
        $this->apartmentRepository->get(1);
    }

    public function areaSearch(Request $request)
    {
        $input = $request->all();
    }
}