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
    const DEFAULT_RATING_POINT = 3;
    const DEFAULT_COMMENT_CONTENT = '';
    /**
     * @var Rating
     */
    protected $rating;

    /**
     * @var Comment
     */
    protected $comment;

    /**
     * @var User
     */
    protected $reviewer;

    /**
     * @var Apartment
     */
    protected $reviewedApartment;


    /**
     * Review constructor.
     * @param User $reviewer
     * @param Apartment $reviewedApartment
     */
    public function __construct(
        User $reviewer,
        Apartment $reviewedApartment
    )
    {
        $this->reviewer          = $reviewer;
        $this->reviewedApartment = $reviewedApartment;
        $this->comment  = new Comment(self::DEFAULT_COMMENT_CONTENT);
        $this->rating   = new Rating(self::DEFAULT_RATING_POINT);
    }

    /**
     * @return User
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }

    /**
     * @return Apartment
     */
    public function getReviewedApartment()
    {
        return $this->reviewedApartment;
    }


    /**
     * @return Rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param Rating $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return Comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param Comment $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }


}