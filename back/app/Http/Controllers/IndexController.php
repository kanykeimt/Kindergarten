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
        $reviews = $this->service->reviews();
        return view('index', compact('reviews'));

    }
}
