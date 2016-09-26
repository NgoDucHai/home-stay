<?php

namespace App\HomeStay\ReviewingService;

use App\HomeStay\Apartment\Apartment;
use App\User;

/**
 * Class Review
 * @package App\HomeStay\ReviewingService
 */
class Review
{
    /**
     * @var Rating
     */
    protected $rating;

    /**
     * @var Comment
     */
    protected $comment;


    /**
     * Review constructor.
     *
     * @param Rating $rating
     * @param Comment $comment
     */
    public function __construct(Rating $rating, Comment $comment)
    {
        $this->rating    = $rating;
        $this->comment   = $comment;
    }
}