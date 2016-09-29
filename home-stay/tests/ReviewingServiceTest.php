<?php

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\ReviewingService\Review;
use App\HomeStay\ReviewingService\ReviewingService;
use App\User;
use App\HomeStay\Apartment\Location;
use Carbon\Carbon;

class ReviewingServiceTest extends TestCase
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

    }

    public function tearDown()
    {
        \DB::table('apartments')->truncate();
        \DB::table('users')->truncate();
        \DB::table('reviews')->truncate();

        parent::tearDown();
    }

    /**
     *
     */
    public function testReviewing()
    {
        /** @var User $reviewer */
        $reviewer       = User::find(1);

        /** @var Apartment $apartment */
        $apartment      = $this->repository->get(1);

        /** @var Review $review */
        $review         = new Review($reviewer, $apartment);
        /** @var ReviewingService $reviewService */
        $reviewService  = new ReviewingService();

        $reviewService->review($review);
        $this->seeInDatabase('reviews', ['rate' => 3, 'comment' => '']);
    }

    public function testGetReviewByApartmentID()
    {
        /** @var Apartment $apartment */
        $apartment = $this->repository->get(1);

        $reviewService = new ReviewingService();

        $result = $reviewService->getReviewByApartmentId($apartment->getId());
    }
}