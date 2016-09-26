<?php

namespace App\HomeStay\ReviewingService;


use App\HomeStay\Apartment\Apartment;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * @var Rating
     */
    protected $rate;

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
     * @return Rating
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param Rating $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
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

    /**
     * @return User
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }

    /**
     * @param User $reviewer
     */
    public function setReviewer($reviewer)
    {
        $this->reviewer = $reviewer;
    }

    /**
     * @return Apartment
     */
    public function getReviewedApartment()
    {
        return $this->reviewedApartment;
    }

    /**
     * @param Apartment $reviewedApartment
     */
    public function setReviewedApartment($reviewedApartment)
    {
        $this->reviewedApartment = $reviewedApartment;
    }

}