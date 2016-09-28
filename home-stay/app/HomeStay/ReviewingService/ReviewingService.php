<?php

namespace App\HomeStay\ReviewingService;



class ReviewingService
{
    public function review(Review $review)
    {
        $reader = new ReviewReader();
        $rawReview = $reader->read($review);
        \DB::table('reviews')->insert([$rawReview]);
    }

    public function getReviewByApartmentId($id)
    {
        /** @var Review $rewiews */
        $reviewRaw = \DB::table('reviews')->where('apartment_id', $id)->get();

        return $reviewRaw;
    }
}