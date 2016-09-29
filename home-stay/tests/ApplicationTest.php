<?php

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Apartment\Location;
use App\HomeStay\Application\ApplicationRepository;
use App\HomeStay\Application\ApplicationWorkFlow;
use App\User;
use Carbon\Carbon;

class ApplicationTest extends TestCase
{
    /**
     * @var ApartmentRepository
     */
    protected $repository;

    /**
     * @var User
     */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->repository   = new ApartmentRepository();

        \DB::table('apartments')->truncate();
        \DB::table('users')->truncate();
        \DB::table('reviews')->truncate();
        \DB::table('applications')->truncate();


        \DB::table('apartments')->insert([
            ['available_from' => Carbon::today()->subDays(3)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 2, 'capacity_to' => 6, 'location' => with(new Location(1, 2))->toSql(), 'city' => 'Bac Giang', 'user_id' => 1],
            ['available_from' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->addDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 1, 'capacity_to' => 1, 'location' => with(new Location(1, 2))->toSql(), 'city' => 'Ho Chi Minh', 'user_id' => 2],
            ['available_from' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->addDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 2, 'capacity_to' => 6, 'location' => with(new Location(21.217803, 105.820313))->toSql(), 'city' => 'Ha Noi', 'user_id' => 2]
        ]);

        \DB::table('reviews')->insert([
            ['user_id' => 1, 'apartment_id' => 1, 'rate' => 3, 'comment' => 'say something'],
            ['user_id' => 1, 'apartment_id' => 1, 'rate' => 5, 'comment' => 'say something1'],
            ['user_id' => 2, 'apartment_id' => 2, 'rate' => 5, 'comment' => 'say something3'],
        ]);

        \DB::table('users')->insert([
            ['name' => 'Hai Ngo', 'email' => 'haingo6394@gmail.com', 'password' => '12345'],
            ['name' => 'Hai Ngo1', 'email' => 'haingo63941@gmail.com', 'password' => '12345'],
            ['name' => 'Hai Ngo2', 'email' => 'haingo63942@gmail.com', 'password' => '12345'],
        ]);

        \DB::table('applications')->insert([
            ['user_id' => 1, 'apartment_id' => 1, 'state' => 'PENDING'],
            ['user_id' => 1, 'apartment_id' => 3, 'state' => 'PENDING'],
            ['user_id' => 2, 'apartment_id' => 2, 'state' => 'PENDING']
        ]);

    }

    public function tearDown()
    {
        \DB::table('apartments')->truncate();
        \DB::table('users')->truncate();
        \DB::table('reviews')->truncate();
        \DB::table('applications')->truncate();

        parent::tearDown();
    }

    public function testMakeApplication()
    {
        /** @var User $applicant */
        $applicant       = User::find(1);

        /** @var Apartment $apartment */
        $apartment         = $this->repository->get(1);

        /** @var ApplicationWorkFlow $applicationWorkFlow */
        $applicationWorkFlow = new ApplicationWorkFlow();

        $applicationWorkFlow->make($applicant, $apartment);
        $this->seeInDatabase('applications', ['user_id' => 1, 'apartment_id' => 1, 'state' => 'PENDING']);
    }

    public function testAcceptApplication()
    {
        $applicationRepo = new ApplicationRepository();
        $application = $applicationRepo->get(2);

        $applicationWorkFlow = new ApplicationWorkFlow();

        $applicationWorkFlow->accept($application);
        $this->seeInDatabase('applications', ['user_id' => 1, 'apartment_id' => 3, 'state' => 'ACCEPTED']);

    }

    public function testDealApplication()
    {
        $applicationRepo = new ApplicationRepository();
        $application = $applicationRepo->get(2);

        $applicationWorkFlow = new ApplicationWorkFlow();

        $applicationWorkFlow->deal($application);
        $this->seeInDatabase('applications', ['user_id' => 1, 'apartment_id' => 3, 'state' => 'DEAL']);

    }

    public function testCancelApplicaton()
    {
        $applicationRepo = new ApplicationRepository();
        $application = $applicationRepo->get(2);

        $applicationWorkFlow = new ApplicationWorkFlow();

        $applicationWorkFlow->cancel($application);
        $this->seeInDatabase('applications', ['user_id' => 1, 'apartment_id' => 3, 'state' => 'CANCELLED']);

    }
}