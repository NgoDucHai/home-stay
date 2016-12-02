<?php
/**
 * Created by IntelliJ IDEA.
 * User: hai
 * Date: 02/12/2016
 * Time: 01:10
 */

namespace App\Http\Controllers;


use App\HomeStay\ReviewingService\Comment;
use App\HomeStay\ReviewingService\Rating;
use App\HomeStay\ReviewingService\Review;
use App\HomeStay\ReviewingService\ReviewingService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @var reviewingService
     */
    protected $reviewingService;
    /**
     * ReviewController constructor.
     * @param ReviewingService $reviewingService
     */
    public function __construct(ReviewingService $reviewingService)
    {
        $this->reviewingService = $reviewingService;
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $apartmentId = $request->apartmentId;
        $user = \Auth::user();
        $rating = new Rating($request->rate);
        $comment = new Comment($request->comment);
        $review = new Review($rating, $comment);
        $this->reviewingService->doReview($user->getId(), $apartmentId, $review);
    }
}