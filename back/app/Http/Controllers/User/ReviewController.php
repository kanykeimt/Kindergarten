<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ReviewController extends Controller
{
    public function create(Request $request){
        $data = $request->validate([
            'user_id' => 'required',
            'rating' => 'required',
            'comment' => 'required'
        ]);
        Review::create([
            'user_id' => $data['user_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment']
        ]);
        $message = Lang::get('lang.feedback_accepted_msg');
        return redirect()->route('index')->with('status',$message);
    }
}
