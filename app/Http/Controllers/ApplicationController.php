<?php

namespace App\Http\Controllers;

use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Application\ApplicationWorkFlow;
use App\User;
use DB;
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
        $userId = \Auth::user()->getId();
        $apartment = $this->apartmentRepository->get($apartmentId);
        $application = $this->applicationWorkFlow->make($userId, $apartmentId, $messageUser);
        $application->save();
        $data = array (
            'bodyMessage' => $messageUser,
            'urlApplication'         => 'http://localhost:8000/application/'.$application->getId()
        );

        $this->sendEmail($apartment->getOwner(), $data);
        return Response::json([
            'message' => 'Dat phong thanh cong'
        ]);
    }

    public function get()
    {
        $user = \Auth::user();
        $applications = $this->applicationWorkFlow->getListApplicationByUserId($user->getId());
//        $applicationsOwner = $this->applicationWorkFlow->getListApplicationByOwnerId($user->getId());
        return view('application',[
            'applications'       => $applications
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

    public function choose($id)
    {
        $rawApplication = $this->applicationWorkFlow->getApplicationById($id);
        $applicant = DB::table('users')->where('id', $rawApplication->user_id)->first();
        return view('choose',[
            'user'              => $applicant,
            'application'       => $rawApplication
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept($id){
        $user = \Auth::user();
        $rawApplication = $this->applicationWorkFlow->getApplicationById($id);
        $application = $this->applicationWorkFlow->make($rawApplication->user_id, $rawApplication->apartment_id, $rawApplication->message);
        $application->setId($id);
        $this->applicationWorkFlow->accept($user, $application);
        $owner = \DB::table('users')->where('id', $rawApplication->user_id)->first();
        dd($owner);
        $data = array (
            'bodyMessage' => $user->getName().' da dong y yeu cau thue phong cua ban.',
            'urlApplication'         => 'http://localhost:8000/application/'.$application->getId()
        );
        $this->sendEmail($owner, $data);
        return Response::json([
            'message' => 'Accept success'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel($id){
        $user = \Auth::user();
        $rawApplication = $this->applicationWorkFlow->getApplicationById($id);
        $application = $this->applicationWorkFlow->make($rawApplication->user_id, $rawApplication->apartment_id, $rawApplication->message);
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
        $user = \Auth::user();
        $rawApplication = $this->applicationWorkFlow->getApplicationById($id);
        $application = $this->applicationWorkFlow->make($rawApplication->user_id, $rawApplication->apartment_id, $rawApplication->message);
        $this->applicationWorkFlow->deal($application);
        return Response::json([
            'message' => 'Deal success'
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