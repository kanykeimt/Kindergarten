<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\CreateRequest;
use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Models\Menu;
use App\Services\Admin\MenuService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class MenuController extends Controller
{
    private MenuService $service;
    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }
    public function index(){
        $formattedDates = $this->service->dates();
        $menus = $this->service->menus();
        return view('admin.menu.index', compact('formattedDates', 'menus'));
    }

    public function create(CreateRequest $request){
        $message = $this->service->create($request);
        return redirect()->route('admin.menu.index')->with('success', $message);
    }

    public function edit($date){
        $menus = Menu::where('date', $date)->get();
        foreach ($menus as $menu) {
            if($menu->meals == "breakfast")
                $menu->meals = Lang::get('lang.breakfast');
            elseif($menu->meals == "lunch")
                $menu->meals = Lang::get('lang.lunch');
            elseif($menu->meals == "snack")
                $menu->meals = Lang::get('lang.snack');
            elseif($menu->meals == "dinner")
                $menu->meals = Lang::get('lang.dinner');
        }
        return view('admin.menu.edit', compact('menus'));
    }

    public function update(UpdateRequest $request, Menu $menu){
        $message = $this->service->update($request, $menu);
        return redirect()->route('admin.menu.index')->with('success', $message);
    }
}
