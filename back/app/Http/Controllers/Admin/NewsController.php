<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Models\Media;
use App\Models\Group;
use App\Models\News;
use App\Services\Admin\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    private NewsService $service;
    public function __construct(NewsService $service){
        $this->service = $service;
    }
    public function index(){
        $dates = $this->service->dates();
        $news = $this->service->news();
        $groups = Group::all();

        return view('admin.news.index', compact('news', 'dates', 'groups'));
    }
    public function create(CreateRequest $request){
        $message = $this->service->create($request);
        return redirect()->back()->with('success', $message);
    }
    public function delete($date){
        $galleries = Media::where('created_at', $date)
            ->get();
        foreach ($galleries as $gallery){
            $gallery->delete();
        }
        $message = Lang::get('lang.delete_answer');
        return redirect()->back()->with('status', $message);
    }
}
