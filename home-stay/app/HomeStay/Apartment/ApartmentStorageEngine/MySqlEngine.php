<?php

namespace App\HomeStay\Apartment\ApartmentStorageEngine;

use App\HomeStay\Apartment\Apartment;
use App\HomeStay\Apartment\Location;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\Query\Builder;

/**
 * Class MySqlEngine
 * @package HomeStay\Apartment\ApartmentStorageEngine
 */
class MySqlEngine implements Engine
{
    /**
     * @var MySqlConnection
     */
    protected $connection;

    /**
     * MySqlEngine constructor.
     * @param MySqlConnection $connection
     */
    public function __construct(MySqlConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Apartment $apartment
     */
    public function save(Apartment $apartment)
    {
        // TODO: Implement save() method.
    }

    /**
     * @return Builder
     */
    public function buildQuery()
    {
        return $this->connection
            ->table('apartments')
            ->select(array_merge(['*'], [
                $this->connection->raw("X(location) as lat"),
                $this->connection->raw("Y(location) as lng"),
            ]))
        ;
    }

    /**
     * @param Location $location
     * @return \Illuminate\Database\Query\Expression
     */
    public function convertLocationToSql(Location $location)
    {
        return $this->connection->raw("GeomFromText('POINT({$location->lat()} {$location->lng()})')");
    }
}
