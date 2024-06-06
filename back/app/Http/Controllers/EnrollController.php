<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollCreateRequest;
use App\Models\Child;
use App\Models\Enroll;
use App\Models\User;
use App\Services\EnrollService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EnrollController extends Controller
{
    private EnrollService $service;

    public function __construct(){
        $this->service = new EnrollService();
    }

    public function store(EnrollCreateRequest $request){
        return $this->service->store($request);
    }

}
