<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Gallery;
use App\Models\MainGallery;
use App\Services\IndexService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private IndexService $service;
    public function __construct(IndexService $service)
    {
        $this->service = $service;
    }


    public function index()
    {
        return view('home');
    }

    public function gallery(){
        $galleries = Gallery::all();
        return view('gallery', compact('galleries'));
    }

    public function contact(){
        $user = auth()->user();
        $children = null;
        if($user){
            if($user->role === 'ROLE_ADMIN' or $user->role === 'ROLE_TEACHER' or $user->role === 'ROLE_PARENT'){
                $children = Child::where('parent_id', $user->id)->get();
                return view('user.contact', compact('children'));
            }
            return view('user.contact');
        }
        return view('user.contact');
    }


    public function literature(){
        return view('user.literature');
    }

    public function condition(){
        return view('user.condition');
    }

    public function menu(){
        $formattedDates = $this->service->dates();
        $menus = $this->service->menus();
        return view('user.menu', compact('formattedDates', 'menus'));
    }

    public function faq(){
        $user = auth()->user();
        $children = null;
        if($user){
            if($user->role === 'ROLE_ADMIN' or $user->role === 'ROLE_TEACHER' or $user->role === 'ROLE_PARENT'){
                $children = Child::where('parent_id', $user->id)->get();
                return view('user.faq', compact('children'));
            }
            return view('user.faq');
        }
        return view('user.faq');
    }
}
