<?php

namespace App\Services;

use App\Models\Child;
use App\Models\Review;
use App\Models\User;

class IndexService
{
    public function reviews(){
        $reviews = Review::latest()->take(5)->get();
        return $reviews;
    }

}
