<?php

namespace App\Services;

use App\Models\Child;
use App\Models\Menu;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;

class IndexService
{
    public function reviews(){
        $reviews = Review::latest()->take(5)->get();
        return $reviews;
    }

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

}
