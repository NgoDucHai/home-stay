<?php

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\ApartmentFactory;
use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Apartment\ApartmentStorageEngine\MySqlEngine;
use App\HomeStay\ReviewingService\Comment;
use App\HomeStay\ReviewingService\Rating;
use App\HomeStay\ReviewingService\Review;
use App\HomeStay\ReviewingService\ReviewingService;
use App\User;
use App\HomeStay\Apartment\Location;
use Carbon\Carbon;
use Illuminate\Database\MySqlConnection;

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

    protected $connection;

    protected $mysqlEngine;

    public function setUp()
    {
        parent::setUp();

        $this->connection = \DB::connection();

        if ( ! $this->connection instanceof MySqlConnection) {
            $this->markTestSkipped('Invalid database configuration, [MySql] engine required');
        }

        $this->mysqlEngine = new MySqlEngine($this->connection);

        $this->repository   = new ApartmentRepository($this->mysqlEngine , new ApartmentFactory());

        $this->connection->table('apartments')->truncate();
        $this->connection->table('users')->truncate();
        $this->connection->table('reviews')->truncate();
        $this->connection->table('applications')->truncate();


        $this->connection->table('apartments')->insert([
            ['available_from' => Carbon::today()->subDays(3)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 2, 'capacity_to' => 6, 'location' => with($this->mysqlEngine->convertLocationToSql(new Location(1, 2))), 'city' => 'Bac Giang', 'user_id' => 1],
            ['available_from' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->addDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 1, 'capacity_to' => 1, 'location' => with($this->mysqlEngine->convertLocationToSql(new Location(1, 2))), 'city' => 'Ho Chi Minh', 'user_id' => 2],
            ['available_from' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->addDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 2, 'capacity_to' => 6, 'location' => with($this->mysqlEngine->convertLocationToSql(new Location(21.217803, 105.820313))), 'city' => 'Ha Noi', 'user_id' => 2]
        ]);

        $this->connection->table('reviews')->insert([
            ['user_id' => 1, 'apartment_id' => 1, 'rate' => 3, 'comment' => 'say something'],
            ['user_id' => 1, 'apartment_id' => 1, 'rate' => 5, 'comment' => 'say something1'],
            ['user_id' => 2, 'apartment_id' => 2, 'rate' => 5, 'comment' => 'say something3'],
        ]);

        $this->connection->table('users')->insert([
            ['name' => 'Hai Ngo', 'email' => 'haingo6394@gmail.com', 'password' => '12345'],
            ['name' => 'Hai Ngo1', 'email' => 'haingo63941@gmail.com', 'password' => '12345'],
            ['name' => 'Hai Ngo2', 'email' => 'haingo63942@gmail.com', 'password' => '12345'],
        ]);

        $this->connection->table('applications')->insert([
            ['user_id' => 1, 'apartment_id' => 1, 'state' => 'PENDING'],
            ['user_id' => 1, 'apartment_id' => 3, 'state' => 'PENDING'],
            ['user_id' => 2, 'apartment_id' => 2, 'state' => 'PENDING']
        ]);

    }

    public function tearDown()
    {
        $this->connection->table('apartments')->truncate();
        $this->connection->table('users')->truncate();
        $this->connection->table('reviews')->truncate();
        $this->connection->table('applications')->truncate();

        parent::tearDown();
    }

    /**
     *
     */
    public function testReviewing()
    {
        /** @var User $reviewer */
        $reviewer       = User::find(1);

        $apartment      = $this->repository->get(1);

        $review         = new Review(new Rating(3), new Comment('this is a comment'));
        $reviewService  = new ReviewingService($this->connection);

        $reviewService->doReview($reviewer, $apartment, $review);
        $this->seeInDatabase('reviews', ['rate' => 3, 'comment' => 'this is a comment']);
    }
}