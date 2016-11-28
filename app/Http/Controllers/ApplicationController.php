<?php

namespace App\Http\Controllers;

use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Application\ApplicationWorkFlow;
use Illuminate\Http\Request;
use Response;

/**
 * Class ApplyController
 * @package App\Http\Controllers
 */

class ApplicationController extends Controller
{
    /**
     * @var ApplicationWorkFlow
     */
    protected $applicationWorkFlow;

    /**
     * @var ApartmentRepository
     */
    protected $apartmentRepository;

    /**
     * ApplyController constructor.
     * @param ApplicationWorkFlow $applicationWorkFlow
     * @param ApartmentRepository $apartmentRepository
     */
    public function __construct(ApplicationWorkFlow $applicationWorkFlow, ApartmentRepository $apartmentRepository)
    {
        $this->applicationWorkFlow = $applicationWorkFlow;
        $this->apartmentRepository = $apartmentRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $apartmentId = $request->apartmentId;
        $message = $request->message;
        $user = \Auth::user();
        $apartment = $this->apartmentRepository->get($apartmentId);
        $this->applicationWorkFlow->make($user, $apartment, $message);
        return Response::json([
            'message' => 'Dat phong thanh cong'
        ]);
    }
}