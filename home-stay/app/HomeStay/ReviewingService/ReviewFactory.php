<?php

namespace App\HomeStay\ReviewingService;


use App\HomeStay\Apartment\ApartmentRepository;
use App\User;

class ReviewFactory
{
    /**
     * @param $rawDataReview
     * @return Review
     */
    public function factory($rawDataReview)
    {
        $repo = new ApartmentRepository();
        $reviewer = User::find($rawDataReview['user_id']);
        $reviewedApartment = $repo->get($rawDataReview['apartment_id']);
        $review = new Review($reviewer, $reviewedApartment);
        $review->setComment(new Comment($rawDataReview['comment']));
        $review->setRating(new Rating($rawDataReview['rate']));
        return $review;
    }
}