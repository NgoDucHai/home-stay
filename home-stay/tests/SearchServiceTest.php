<?php

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\ApartmentAreaSearchCondition;
use App\HomeStay\Apartment\ApartmentNearbySearchCondition;
use App\HomeStay\Apartment\ApartmentRepository;
use App\HomeStay\Apartment\Area;
use App\HomeStay\Apartment\Location;

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
            ['available_from' => \Carbon\Carbon::today()->subDays(3)->format('Y-m-d H:i:s'), 'available_to' => \Carbon\Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 3, 'capacity_to' => 5, 'location' => with(new Location(1, 2))->toSql()],
            ['available_from' => \Carbon\Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'available_to' => \Carbon\Carbon::today()->addDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 1, 'capacity_to' => 1, 'location' => with(new Location(1, 2))->toSql()],
            ['available_from' => \Carbon\Carbon::today()->subDays(2)->format('Y-m-d H:i:s'), 'available_to' => \Carbon\Carbon::today()->addDays(2)->format('Y-m-d H:i:s'), 'capacity_from' => 2, 'capacity_to' => 6, 'location' => with(new Location(1, 2))->toSql()]
        ]);

        dd();
    }

    public function tearDown()
    {
        \DB::table('apartments')->truncate();

        parent::tearDown();
    }

    public function testNearbySearchWithDefinedCondition()
    {
        $condition = new ApartmentNearbySearchCondition(new Location(123, 123), 1000);

        $condition
            ->availableIn(\Carbon\Carbon::yesterday(), \Carbon\Carbon::today())
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

//    public function testAreaSearch()
//    {
//        $condition = new ApartmentAreaSearchCondition();
//
//        $condition
//            ->availableIn(new DateTime(), new DateTime())
//            ->hasCapacityFrom(3, 5)
//            ->in(new Area('Hanoi'))
//        ;
//    }
}