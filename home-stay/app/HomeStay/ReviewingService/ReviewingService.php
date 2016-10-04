<?php

namespace App\HomeStay\ReviewingService;

use App\User;
use App\HomeStay\Apartment\Apartment;
use Illuminate\Database\ConnectionInterface;

/**
 * Class ReviewingService
 * @package App\HomeStay\ReviewingService
 */
class ReviewingService
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;


    /**
     * ReviewingService constructor.
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
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
