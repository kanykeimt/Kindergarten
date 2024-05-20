<?php

namespace App\Services\Admin;

use App\Models\Review;

class ReviewService
{

    public function reviews($review_id)
    {
        if ($review_id ==0) {
            $reviews = Review::all()->sortByDesc('created_at');
        }
        else{
            $reviews = Review::where('id', $review_id)->first();
        }

        return $reviews;
    }

}
