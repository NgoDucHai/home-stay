<?php

namespace App\HomeStay\ReviewingService;

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
     * @param Rating $rating
     * @param Comment $comment
     */
    public function __construct(Rating $rating, Comment $comment)
    {
        $this->rating  = $rating;
        $this->comment = $comment;
    }

    /**
     * @return Rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return Comment
     */
    public function getComment()
    {
        return $this->comment;
    }
}
