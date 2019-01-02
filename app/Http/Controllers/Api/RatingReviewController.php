<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RatingReview;
use Illuminate\Http\Request;

class RatingReviewController extends Controller
{
    public function get(Request $request) {
        $data = $request->all();
        $reviews = RatingReview::getMoreReview($data);
        return $reviews;
    }
}
