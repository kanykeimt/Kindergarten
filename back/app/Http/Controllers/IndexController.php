<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Feedback;
use App\Models\MainGallery;
use App\Models\User;
use App\Services\IndexService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private IndexService $service;
    public function __construct(IndexService $service){
        $this->service = $service;
    }
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $reviews = $this->service->reviews();
        if (($user != null) and ($user->role_name == "Admin" or "Teacher" or "Parent")){
            $children = $this->service->children($user);
            return view('index', compact('children', 'reviews'));
        }
        else{
            return view('index', compact('reviews'));
        }
    }
}
