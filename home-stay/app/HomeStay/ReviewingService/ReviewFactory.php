<?php

namespace App\HomeStay\ReviewingService;


use App\HomeStay\Apartment\ApartmentRepository;
use App\User;

class ReviewFactory
{
    public function factory($rawDataReview)
    {
        $reviewer = User::find($rawDataReview['user_id']);
        $reviewedApartment = ApartmentRepository::get($rawDataReview['apartment_id']);
        $review = new Review($reviewer, $reviewedApartment);
        $review->setComment(new Comment($rawDataReview['comment']));
        $review->getRating(new Rating($rawDataReview['rate']));
        return $review;
    }
}