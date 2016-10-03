<?php

namespace App\HomeStay\ReviewingService;

use App\HomeStay\Apartment\Apartment;
use App\User;
use Illuminate\Database\MySqlConnection;

/**
 * Class ReviewingService
 * @package App\HomeStay\ReviewingService
 */
class ReviewingService
{
    /**
     * @var MySqlConnection
     */
    protected $connection;


    /**
     * ReviewingService constructor.
     * @param MySqlConnection $connection
     */
    public function __construct(MySqlConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param User $reviewer
     * @param Apartment $apartment
     * @param Review $review
     */
    public function doReview(User $reviewer, Apartment $apartment, Review $review)
    {
        $this->connection->table('reviews')->insert([
            'user_id'      => $reviewer->getId(),
            'apartment_id' => $apartment->getId(),
            'rate'         => $review->getRating()->getValue(),
            'comment'      => $review->getComment()->getContent()
        ]);
    }
}