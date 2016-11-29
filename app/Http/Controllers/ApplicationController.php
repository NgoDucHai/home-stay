<?php

namespace App\Http\Controllers;

use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Application\ApplicationWorkFlow;
use App\User;
use Illuminate\Http\Request;
use Mail;
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
        $messageUser = $request->message;
        $user = \Auth::user();
        $apartment = $this->apartmentRepository->get($apartmentId);
        $application = $this->applicationWorkFlow->make($user, $apartment, $messageUser);
        $application->save();
        $data = array (
            'bodyMessage' => $messageUser,
            'url'         => 'http://localhost:8000/application/'.$application->getId()
        );
        $this->sendEmail($apartment->getOwner(), $data);
        return Response::json([
            'message' => 'Dat phong thanh cong'
        ]);
    }

    /**
     * @param User $owner
     * @param $data
     */
    public function sendEmail(User $owner, $data)
    {
        Mail::send('email', $data, function ($m) use ($owner) {
            $m->from('hello@app.com', 'Homestay Application');

            $m->to($owner->getEmail(), $owner->getName())->subject('Yêu cầu thuê phòng Homestay');
        });
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept($id){
        $user = \Auth::user();
        $application = $this->applicationWorkFlow->getApplicationById($id);
        $this->applicationWorkFlow->accept($user, $application);
        return Response::json([
            'message' => 'Accept success'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel($id){
        $application = $this->applicationWorkFlow->getApplicationById($id);
        $this->applicationWorkFlow->cancel($application);
        return Response::json([
            'message' => 'Cancel success'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deal($id){
        $application = $this->applicationWorkFlow->getApplicationById($id);
        $this->applicationWorkFlow->deal($application);
        return Response::json([
            'message' => 'Cancel success'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function canAccept($id){
        $user = \Auth::user();
        $application = $this->applicationWorkFlow->getApplicationById($id);
        $this->applicationWorkFlow->canAccept($user, $application);
        return Response::json([
            'message' => 'Cancel success'
        ]);
    }



}