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
            'stars' => 'required',
            'comment' => 'required'
        ]);
        Review::create([
            'user_id' => $data['parent_id'],
            'stars' => $data['stars'],
            'comment' => $data['comment']
        ]);
        dd($data);
        $message = Lang::get('lang.feedback_accepted_msg');
        return redirect()->route('index')->with('status',$message);
    }
}
