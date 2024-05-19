<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Schedule\CreateRequest;
use App\Http\Requests\Admin\Schedule\UpdateRequest;
use App\Models\Classes;
use App\Models\DaysOfWeek;
use App\Models\Group;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ScheduleService
{
    public function daysOfWeek()
    {
        $daysOfWeek = DaysOfWeek::all();

        return $daysOfWeek;
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        $classes = Classes::create([
            'name_kg' => $data['classes_name_kg'],
            'name_ru' => $data['classes_name_ru'],
        ]);

        $groupIds = $data['group_id'] == 0 ? Group::all()->pluck('id') : collect([$data['group_id']]);
        $daysOfWeek = $data['day'] == 0 ? DaysOfWeek::all()->pluck('id') : collect([$data['day']]);

        foreach ($groupIds as $groupId) {
            foreach ($daysOfWeek as $day) {
                Schedule::create([
                    'classes_id' => $classes->id,
                    'group_id' => $groupId,
                    'day' => $day,
                    'time_from' => $data['time_from'],
                    'time_to' => $data['time_to'],
                ]);
            }
        }
        return Lang::get('lang.add_schedule_successful');
    }

    public function schedules()
    {
        $schedules = Schedule::all();

        foreach ($schedules as $schedule) {
            $schedule->class_name = $schedule->class->name;
        }
        $schedules = $schedules->sortBy([
            ['group_id', 'asc'],
            ['day', 'asc'],
            ['time_from', 'asc']
        ]);

        return $schedules;
    }

    public function edit($group_id, $day_id){
        $schedules = Schedule::where('group_id', $group_id)
        ->where('day', $day_id)
        ->select('id','classes_id', 'time_from', 'time_to')
        ->get();

        $schedules = $schedules->sortBy([
            ['time_from', 'asc']
        ]);

        return $schedules;
    }

    public function update(UpdateRequest $request)
    {
        $requestData = $request->all();
        $data = [
            'group_id' => $requestData['group_id'],
            'day' => $requestData['day'],
            'schedules' => []
        ];

        foreach ($requestData as $key => $value) {
            if (strpos($key, 'classes_id-') === 0) {
                // Extract the index from the parameter name
                $index = (int) substr($key, strlen('classes_id-'));

                $schedule = [
                    'id' => $requestData['id-'.$index],
                    'classes_id' => $value,
                    'time_from' => $requestData['time_from-' . $index],
                    'time_to' => $requestData['time_to-' . $index]
                ];

                // Add the schedule array to the 'schedules' array
                $data['schedules'][] = $schedule;
            }
        }
        foreach ($data['schedules'] as $schedule) {
            $schedules = Schedule::where('id', $schedule['id'])->first();
            DB::beginTransaction();
            $schedules->update([
                'classes_id' => $schedule['classes_id'],
                'group_id' => $data['group_id'],
                'day' => $data['day'],
                'time_from' => $schedule['time_from'],
                'time_to' => $schedule['time_to']
            ]);
            DB::commit();
        }

        return Lang::get('lang.update_user_successful');
    }
}
