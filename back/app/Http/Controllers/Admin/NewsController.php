<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class NewsController extends Controller
{
    public function index(){
        $news = Gallery::all()->sortByDesc('created_at');
        $groupses = Group::all();
        $created_at_dates = DB::table('galleries')
            ->select('created_at', 'group_id')
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();
        $count = [];
        $index = 0;
        foreach ($created_at_dates as $created_at_date){
            $i = 0;
            foreach ($news as $new){
                if ($created_at_date === $new->created_at){
                    $i++;
                }
            }
            $count[$index] = $i;
            $index++;
        }
        return view('admin.news.index', compact('news', 'groupses', 'created_at_dates', 'count'));
    }
    public function delete($new){
        dd($new);
        $gallery = Gallery::where('id', $new)
            ->get();
        $gallery->delete();
        foreach ($galleries as $gallery){
            $gallery->delete();
        }
        $message = Lang::get('lang.delete_answer');
        return redirect()->back()->with('status', $message);
    }
}
