<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Models\Gallery;
use App\Models\Group;
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
        $groups = Group::all();
        return view('admin.news.index', compact('groups'));
    }
    public function create(CreateRequest $request){
        dd($request);
        $data = $request->validate([
            'groupId' => 'required',
            'info' => ''
        ]);
        if($request->has('images')){
            foreach ($request->file('images') as $image) {
                $imageName = Storage::disk('public')->put('group_gallery', $image);
                $imageName = "storage/".$imageName;

                Gallery::create([
                    'group_id'=>$data['groupId'],
                    'image'=>$imageName,
                    'video'=>null,
                    'info'=>$data['info']
                ]);
            }
        }
        if($request->has('videos')){
            foreach ($request->file('videos') as $video) {
                $videoName = Storage::disk('public')->put('group_gallery', $video);
                $videoName = "storage/".$videoName;
                Gallery::create([
                    'group_id'=>$data['groupId'],
                    'image'=>null,
                    'video'=>$videoName,
                    'info' => $data['info']
                ]);
            }
        }
        $message = Lang::get('lang.add_successful');
        return redirect()->back()->with('success', $message);
    }
    public function delete($date){
        $galleries = Gallery::where('created_at', $date)
            ->get();
        foreach ($galleries as $gallery){
            $gallery->delete();
        }
        $message = Lang::get('lang.delete_answer');
        return redirect()->back()->with('status', $message);
    }
}
