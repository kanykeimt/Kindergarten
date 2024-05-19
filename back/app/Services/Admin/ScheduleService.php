<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Schedule\CreateRequest;
use App\Models\Classes;
use App\Models\DaysOfWeek;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class ScheduleService
{
    public function daysOfWeek()
    {
        $lang = app()->getLocale();
        $daysOfWeek = DaysOfWeek::all();

        // Translate questions based on the current locale
        foreach ($daysOfWeek as $day) {
            $day->name = $lang == 'kg' ? $day->name_kg : $day->name_ru;
        }
        return $daysOfWeek;
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        $classes = Classes::create([
            'name_kg' => $data['classes_name_kg'],
            'name_ru' => $data['classes_name_ru'],
        ]);

        Schedule::create([
            'classes_id' => $classes->id,
            'group_id' => $data['group_id'],
            'day' => $data['day'],
            'time_from' => $data['time_from'],
            'time_to' => $data['time_to'],
        ]);

        $message = Lang::get('lang.add_schedule_successful');
        return $message;
    }

    public function schedules()
    {
        $lang = app()->getLocale();
        if ($lang == 'kg'){
            $schedules = Schedule::select('groups.id as group_id', 'days_of_week.id as day', 'classes.name_kg as class_name', 'schedules.time_from', 'schedules.time_to')
                ->join('groups', 'schedules.group_id', '=', 'groups.id')
                ->join('days_of_week', 'schedules.day', '=', 'days_of_week.id')
                ->join('classes', 'schedules.classes_id', '=', 'classes.id')
                ->orderBy('groups.id')
                ->orderBy('days_of_week.id')
                ->orderBy('classes.name_ru')
                ->get();
        }
        else{
            $schedules = Schedule::select('groups.id as group_id', 'days_of_week.id as day', 'classes.name_ru as class_name', 'schedules.time_from', 'schedules.time_to')
                ->join('groups', 'schedules.group_id', '=', 'groups.id')
                ->join('days_of_week', 'schedules.day', '=', 'days_of_week.id')
                ->join('classes', 'schedules.classes_id', '=', 'classes.id')
                ->orderBy('groups.id')
                ->orderBy('days_of_week.id')
                ->orderBy('classes.name_ru')
                ->get();
        }

        return $schedules;
    }
}
