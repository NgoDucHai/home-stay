<?php

namespace App\Http\Controllers;

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\ApartmentAreaSearchCondition;
use App\HomeStay\Apartment\ApartmentRepository;
use App\Http\Presenters\ApartmentPresenter;
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
     * ApartmentController constructor.
     * @param ApartmentRepository $apartmentRepository
     */
    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|Collection
     */
    public function index()
    {
        $apartments = $this->apartmentRepository->getList();

        if ( ! $apartments)
        {
            return \Response::json([
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
     * @param Apartment $apartment
     */
    public function store(Apartment $apartment)
    {
        $this->apartmentRepository->save($apartment);
    }

    /**
     * @param $id
     * @return ApartmentPresenter|\Illuminate\Http\JsonResponse
     */
    public function edit($id)
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $apartment = $this->apartmentRepository->destroy($id);
        if ( ! $apartment)
        {
            return \Response::json([
                'error' => 'E_NOT_FOUND',
                'message' => "No apartments with id [$id] was found"
            ], 404);
        }
    }

    public function search(ApartmentAreaSearchCondition $condition)
    {
        $apartments = $this->apartmentRepository->find($condition);
        return new Collection(array_map(
            function ($apartment) {
                return new ApartmentPresenter($apartment);
            }, $apartments->toArray()));
    }
}
