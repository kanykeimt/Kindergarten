<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Services\Employee\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private NewsService $service;
    public function __construct(NewsService $service){
        $this->service = $service;
    }

    public function index(){
        $dates = $this->service->dates();
        $news = $this->service->news();
        return view('employee.news.index', compact('news', 'dates'));
    }

    public function create(CreateRequest $request)
    {
        $message = $this->service->create($request);
        return redirect()->back()->with('success', $message);
    }

    public function delete($date){
        $message = $this->service->delete($date);
        return redirect()->back()->with('success', $message);
    }
}
