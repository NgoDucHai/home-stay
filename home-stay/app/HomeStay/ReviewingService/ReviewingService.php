<?php

namespace App\HomeStay\ReviewingService;


use App\HomeStay\Apartment\Apartment;
use App\User;

class ReviewingService
{
    public function review(User $reviewer, Apartment $apartment, Review $review)
    {
        \DB::table('reviews')->insert([
            'user_id' => $reviewer->id,
            'apartment_id' => $apartment->getId(),
            'rate' => $review->getRatingPoint(),
            'comment' => $review->getCommentContent()
        ]);
    }
}