<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Review;
use App\Services\Admin\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ReviewController extends Controller
{
    private ReviewService $service;
    public function __construct(ReviewService $service){
        $this->service = $service;
    }
    private $review_id = 0;

    public function index(){
        $reviews = $this->service->reviews($this->review_id);
        return view('admin.review.index', compact('reviews'));
    }

    public function delete(Review $review){
        $review->delete();
        $message = Lang::get('lang.delete_answer_feedback');
        return redirect()->route('admin.review.index')->with('status', $message);
    }

    public function show(Review $review){
        $review =$this->service->reviews($review->id);
        return view('admin.review.show', compact('review'));
    }

}
