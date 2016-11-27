<?php

namespace App\HomeStay\Policies;

use Illuminate\Database\ConnectionInterface;

/**
 * Class UserOwnApartmentPolicy
 * @package App\HomeStay\Policies
 */
class UserOwnApartmentPolicy
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * UserOwnApartmentPolicy constructor.
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $userId
     * @param $apartmentId
     * @return bool
     */
    public function check($userId, $apartmentId)
    {
        return !!$this->connection->table('apartments')
            ->where('id', $apartmentId)
            ->where('user_id', $userId)
            ->count()
        ;
    }
}
