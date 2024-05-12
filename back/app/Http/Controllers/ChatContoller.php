<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chat\CreateRequest;
use App\Services\ChayService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;

class ChatContoller extends Controller
{
    private ChayService $service;
    public function __construct(ChayService $service){
        $this->service = $service;
    }
    public function create(CreateRequest $request):RedirectResponse
    {
        return $this->service->create($request);
    }
}
