<?php

namespace App\HomeStay\Policies;

use App\User;
use Illuminate\Database\MySqlConnection;

class UserOwnApartmentPolicy
{
    protected $connection;

    public function __construct(MySqlConnection $connection)
    {
        $this->connection = $connection;
    }

    public function check($userId, $apartmentId)
    {
        return !!$this->connection->table('apartments')
            ->where('id', $apartmentId)
            ->where('user_id', $userId)
            ->count()
        ;
    }
}
