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
     * @var ReviewFactory
     */
    protected $factory;


    /**
     * ReviewingService constructor.
     * @param ConnectionInterface $connection
     * @param ReviewFactory $factory
     */
    public function __construct(ConnectionInterface $connection, ReviewFactory $factory)
    {
        $this->connection = $connection;
        $this->factory    = $factory;
    }

    /**
     * @param $reviewerId
     * @param $apartmentId
     * @param Review $review
     */
    public function doReview($reviewerId, $apartmentId, Review $review)
    {
        $this->connection->table('reviews')->insert([
            'user_id'      => $reviewerId,
            'apartment_id' => $apartmentId,
            'rate'         => $review->getRating()->getValue(),
            'comment'      => $review->getComment()->getContent()
        ]);
    }

    public function getReviewById($id)
    {
        $rawData = $this->connection->table('reviews')->where('apartment_id', $id)->get();
        return $this->factory->factoryList($rawData);
    }
}
