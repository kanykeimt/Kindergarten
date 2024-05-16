<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Feedback;
use App\Models\MainGallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->user){
            $user = User::where('id', $request->user)->get();
            if(count($user)){
                Auth::login($user[0]);
            }

        }
        $user = auth()->user();
        $reviews = DB::table('reviews')
            ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
            ->select('reviews.rating', 'reviews.comment', 'users.name', 'users.surname', 'users.profile_photo')
            ->get();
        if($user){
            if($user->role === 1 or $user->role === 2 or $user->role === 3 or $user->role === 4){
                $children = Child::where('parent_id', $user->id)->get();
                return view('index', compact('children', 'reviews'));
            }
        }
        return view('index',compact( 'reviews'));
    }
}
