<?php

namespace App\HomeStay\ReviewingService;


use App\User;
use Illuminate\Support\Collection;

class ReviewFactory
{
    /**
     * @param $rawReview
     * @return Review
     */
    public function factory($rawReview)
    {
        $reviewer = User::findOrFail($rawReview->user_id);
        $review = new Review(new Rating($rawReview->rate), new Comment($rawReview->comment));
        return $review->setReviewer($reviewer);
    }

    /**
     * @param $rawReviews
     * @return Collection
     */
    public function factoryList($rawReviews)
    {
        return new Collection(array_map(
            function ($rawReview) {
                return $this->factory($rawReview) ;
            }, $rawReviews));
    }
}