<?php

namespace App\HomeStay\ReviewingService;



class ReviewReader
{
    /**
     * @param \App\HomeStay\ReviewingService\Review $review
     * @return array
     */
    public function read(Review $review)
{
    return [
        'user_id'       => $review->getReviewer()->getId(),
        'apartment_id'  => $review->getReviewedApartment()->getId(),
        'rate'          => $review->getRating()->getValue(),
        'comment'       => $review->getComment()->getContent()
    ];
}
}