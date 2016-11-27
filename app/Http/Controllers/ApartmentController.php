<?php

namespace App\Http\Controllers;

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\ApartmentAreaSearchCondition;
use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\ReviewingService\ReviewingService;
use App\Http\Presenters\ApartmentPresenter;
use Response;
use Illuminate\Support\Collection;

/**
 * Class ApartmentController
 * @package App\Http\Controllers
 */
class ApartmentController extends Controller
{
    /**
     * @var ApartmentRepository
     */
    protected $apartmentRepository;
    /**
     * @var ReviewingService
     */
    protected $reviewingService;

    /**
     * ApartmentController constructor.
     * @param ApartmentRepository $apartmentRepository
     * @param ReviewingService $reviewingService
     */
    public function __construct(ApartmentRepository $apartmentRepository, ReviewingService $reviewingService)
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->reviewingService = $reviewingService;
    }

    /**
     * show list all apart ment
     * @return \Illuminate\Http\JsonResponse|Collection | Response
     */
    public function index()
    {
        $apartments = $this->apartmentRepository->getList();
        if ( ! $apartments)
        {
            return Response::json([
                'error' => 'E_NOT_FOUND',
                'message' => "No apartment"
            ], 404);
        }
        return new Collection(array_map(
            function ($apartment) {
                return new ApartmentPresenter($apartment);
            }, $apartments->toArray()));
    }

    /**
     * show a form create a new apartment
     */

    public function create()
    {
        
    }

    /**
     * @param Apartment $apartment
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Apartment $apartment)
    {
        $this->apartmentRepository->save($apartment);
        return Response::json([
            'state'   =>  "Ok",
            'message' => "Added apartments ",
            'id'      => $apartment->getId()
        ], 200);
    }

    /**
     * show form editing for a apartment
     * @param $id
     * @return ApartmentPresenter|\Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $apartment = $this->apartmentRepository->get($id);

        if ( ! $apartment)
        {
            return Response::json([
                'error' => 'E_NOT_FOUND',
                'message' => "No apartments with id [$id] was found"
            ], 404);
        }

        return new ApartmentPresenter($apartment);
    }

    /**
     * display the detail of apartment
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    public function read($id)
    {
        $apartment = $this->apartmentRepository->get($id);

        $reviews = $this->reviewingService->getReviewById($id);
        if($reviews->count()){
            $apartment->setReviews($reviews);
        }
        if ( ! $apartment)
        {
            return Response::json([
                'error' => 'E_NOT_FOUND',
                'message' => "No apartments with id [$id] was found"
            ], 404);
        }
        $apartmentDetail =  new ApartmentPresenter($apartment);
        return view('detail',[
            'apartmentDetail' => json_decode($apartmentDetail->toJson())
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $apartment = $this->apartmentRepository->destroy($id);
        if ( ! $apartment)
        {
            return Response::json([
                'error' => 'E_NOT_FOUND',
                'message' => "No apartments with id [$id] was found"
            ], 404);
        }
        return Response::json([
            'message' => "Deleted apartments with id [$id]"
        ], 200);
    }

    /**
     * @param ApartmentAreaSearchCondition $condition
     * @return Collection
     */
    public function search(ApartmentAreaSearchCondition $condition)
    {
        $apartments = $this->apartmentRepository->find($condition);
        $listApartment = [];
        foreach ($apartments->toArray() as $key => $apartment){
            $apartmentJson = new ApartmentPresenter($apartment);
            $listApartment[$key] = $apartmentJson->toJson();
        }
        return view('search',[
            'listApartment' => json_encode($listApartment)
        ]);
    }

}
