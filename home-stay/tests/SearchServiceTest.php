<?php

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\ApartmentAreaSearchCondition;
use App\HomeStay\Apartment\ApartmentNearbySearchCondition;
use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Apartment\Area;
use App\HomeStay\Apartment\Location;
use Carbon\Carbon;

class SearchServiceTest extends TestCase
{
    /**
     * @var ApartmentRepository
     */
    protected $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = new ApartmentRepository();
        \DB::table('apartments')->truncate();


        \DB::table('apartments')->insert([
            ['available_from' => Carbon::today()->subDays(3)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 2, 'capacity_to' => 6, 'location' => with(new Location(1, 2))->toSql(), 'city' => 'Bac Giang'],
            ['available_from' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->addDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 1, 'capacity_to' => 1, 'location' => with(new Location(1, 2))->toSql(), 'city' => 'Ho Chi Minh'],
            ['available_from' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'available_to' => Carbon::today()->addDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 2, 'capacity_to' => 6, 'location' => with(new Location(21.217803, 105.820313))->toSql(), 'city' => 'Ha Noi']
        ]);

    }

    public function tearDown()
    {
        \DB::table('apartments')->truncate();

        parent::tearDown();
    }

    public function testNearbySearchWithDefinedCondition()
    {


        $condition = new ApartmentNearbySearchCondition(new Location(20.988929,105.872498), 100);

        $condition
            ->availableIn(Carbon::yesterday(), Carbon::today())
            ->hasCapacityFrom(3, 5)
        ;

        $result = $this->repository->find($condition);
        $this->assertEquals(1, $result->count());

        /** @var Apartment $foundApartment */
        $foundApartment = $result->first();

        $this->assertEquals(3, $foundApartment->getId());
        $this->assertLessThan(3, $foundApartment->getCapacityFrom());
        $this->assertGreaterThan(5, $foundApartment->getCapacityTo());
    }

    public function testAreaSearch()
    {
        $condition = new ApartmentAreaSearchCondition();

        $condition
            ->availableIn(Carbon::yesterday(), Carbon::today())
            ->hasCapacityFrom(3, 5)
            ->in(new Area('Bac Giang'));
        ;

        $result = $this->repository->find($condition);
        dd($result);
        $this->assertEquals(1, $result->count());
        $foundApartment = $result->first();

        $this->assertEquals(3, $foundApartment->getId());
        $this->assertLessThan(3, $foundApartment->getCapacityFrom());
        $this->assertGreaterThan(5, $foundApartment->getCapacityTo());
    }
}