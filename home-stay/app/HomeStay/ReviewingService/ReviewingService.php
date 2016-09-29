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
        $factory = new ReviewFactory();
        /** @var Review $rewiews */
        $reviewRaw = \DB::table('reviews')->where('apartment_id', $id)->get();
        $reviewList = [];
        foreach ($reviewRaw as $k => $review){
            $reviewList[$k] = $factory->factory($this->ObjectToArray($review));
        }
        return $reviewList;
    }

    private function ObjectToArray($stdObject){
        if( is_object($stdObject))
        {
            return get_object_vars($stdObject);
        }
        return $stdObject;
    }
}