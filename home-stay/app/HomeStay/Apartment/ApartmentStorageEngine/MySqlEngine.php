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
        $rawDataToSave = [
            'available_from' => $apartment->getAvailabilities()[0]->format('Y-m-d H:i:s'),
            'available_to'   => $apartment->getAvailabilities()[1]->format('Y-m-d H:i:s'),
            'capacity_from'  => $apartment->getCapacity()[0],
            'capacity_to'    => $apartment->getCapacity()[1],
            'city'           => $apartment->getCity(),
            'user_id'        => $apartment->getOwner()->getId(),
            'location'       => $this->convertLocationToSql($apartment->getLocation()),
            'name'           => $apartment->getName(),
            'description'    => $apartment->getDescription(),
            'images'         => json_encode($apartment->getImages()),
            'price'          => $apartment->getPrice()
        ];

        if ($apartment->getId())
        {
            $rawDataToSave['updated_at'] = with(new \DateTime())->format('Y-m-d H:i:s');
            $this->connection->table('apartments')->where('id', $apartment->getId())->update($rawDataToSave);
        }
        else
        {
            $rawDataToSave['created_at'] = with(new \DateTime())->format('Y-m-d H:i:s');
            $this->connection->table('apartments')->insert($rawDataToSave);

            $apartment->setId($this->connection->getPdo()->lastInsertId());
        }
    }

    /**
     * @return Builder
     */
    public function buildQuery()
    {
        return $this->connection
            ->table('apartments')
            ->select([
                'id',
                'available_from',
                'available_to',
                'capacity_from',
                'capacity_to',
                'created_at',
                'updated_at',
                'city',
                'user_id',
                'name',
                'description',
                'images',
                'price',
                $this->connection->raw("X(location) as lat"),
                $this->connection->raw("Y(location) as lng"),
            ])
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
