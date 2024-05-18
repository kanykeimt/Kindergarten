<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private MenuService $service;
    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }
    public function index(){
        return view('admin.menu.index');
    }
}
