<?php

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\ApartmentFactory;
use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Apartment\ApartmentStorageEngine\MySqlEngine;
use App\HomeStay\Apartment\Location;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\MySqlConnection;

use Mockery as m;


class ApartmentDetailTest extends TestCase
{
    /**
     * @var ApartmentRepository
     */
    protected $repository;

    /**
     * @var MySqlConnection
     */
    protected $connection;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var MySqlEngine
     */
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
    }

    public function tearDown()
    {
        $this->connection->table('apartments')->truncate();
        $this->connection->table('users')->truncate();
        $this->connection->table('reviews')->truncate();

        parent::tearDown();
    }

    public function testApartmentDetail()
    {

        $apartment = $this->repository->get(1);

        $this->assertInstanceOf(Apartment::class, $apartment);

        $this->assertEquals(1, $apartment->getId());
        $this->assertEquals(1, $apartment->getOwner()->getId());
    }
}