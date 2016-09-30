<?php

namespace App\HomeStay\Apartment;

use Illuminate\Database\MySqlConnection;
use Illuminate\Support\Collection;

/**
 * Class ApartmentRepository
 * @package App\HomeStay\Apartment
 */
class ApartmentRepository
{
    protected $connection;

    public function __construct(MySqlConnection $connection, ApartmentFactory $apartmentFactory)
    {
        $this->connection = $connection;
        $this->apartmentFactory = $apartmentFactory;
    }

    /**
     * @param ApartmentSearchCondition $condition
     * @return Collection
     */
    public function find(ApartmentSearchCondition $condition)
    {
        $query = $this->connection->table('apartments');
        $condition->decorateQuery($query);

        $rawApartments = $query->get(array_merge(['*'], Location::toSelectFields('location')));

        return $this->apartmentFactory->factoryList($rawApartments);
    }

    /**
     * @param $id
     * @return Apartment
     */
    public function get($id)
    {
        return $this->apartmentFactory->factory(
            $this->connection->table('apartments')
                ->find($id, array_merge(['*'], Location::toSelectFields('location')))
        );
    }
}
