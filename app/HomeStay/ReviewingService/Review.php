<?php

namespace App\HomeStay\ReviewingService;
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
     * @var User
     */
    protected $reviewer;

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

    /**
     * @param User $reviewer
     * @return self
     */
    public function setReviewer(User $reviewer)
    {
        $this->reviewer = $reviewer;
        return $this;
    }

    /**
     * @return reviewer
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }
}
