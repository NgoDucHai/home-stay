<?php

namespace App\AdminApi\Controllers;

use App\AdminApi\Entities\Review;

class ReviewController extends RestController
{
    protected function getModelClass()
    {
        return Review::class;
    }

}