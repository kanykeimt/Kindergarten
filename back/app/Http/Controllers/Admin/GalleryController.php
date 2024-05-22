<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\CreateRequest;
use App\Services\Admin\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private GalleryService $service;
    public function __construct(GalleryService $service){
        $this->service = $service;
    }

    public function index(){
        $dates = $this->service->dates();
        $galleries = $this->service->galleries();
        return view('admin.gallery.index', compact('dates', 'galleries'));
    }

    public function create(CreateRequest $request){
        $message = $this->service->create($request);
        return redirect()->route('admin.gallery.index')->with('success', $message);
    }

    public function delete($date){
        $message = $this->service->delete($date);
        return redirect()->back()->with('success', $message);
    }
}
