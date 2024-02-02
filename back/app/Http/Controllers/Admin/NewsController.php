<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Group;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news = Gallery::all()->sortByDesc('created_at');
//        dd($news);
        $groups = Group::all();
        return view('admin.news.index', compact('news', 'groups'));
    }
}
