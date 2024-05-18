<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Menu\CreateRequest;
use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class MenuService
{
    public function menus()
    {
        $menus = Menu::all();
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
        return $menus;
    }
    public function dates()
    {
        $dates = Menu::select('date')
            ->distinct()
            ->get();

        $formattedDates = $dates->map(function($date) {
            $carbonDay = lcfirst(Carbon::parse($date->date)->format('l'));
            return [
                'date' => $date->date,
                'day' => Lang::get('lang.'.$carbonDay)
            ];
        });

        return $formattedDates;
    }

    public function create(CreateRequest $request) {
        $data = $request->validated();

        $directory = 'public/menus';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
        $image = Storage::disk('public')->put('menus', $data['image']);
        $image = "storage/".$image;

        Menu::create([
            'name' => $data['name'],
            'date' => $data['date'],
            'meals' => $data['meals'],
            'calories' => $data['calories'],
            'image' => $image,
        ]);

        $message = Lang::get('lang.add_menu_successful');
        return $message;
    }


    public function update(UpdateRequest $request, Menu $menu)
    {
        $data = $request->validated();
        DB::beginTransaction();
        $image = $menu->image;
        if(array_key_exists('image', $data)){
            $image = Storage::disk('public')->put('menus', $data['image']);
            $image = "storage/".$image;
        }

        $menu->update([
            'name' => $data['name'],
            'date' => $data['date'],
            'meals' => $menu->meals,
            'calories' => $data['calories'],
            'image' => $image,
        ]);
        DB::commit();

        $message = Lang::get('lang.update_menu_successful');
        return $message;
    }

}
