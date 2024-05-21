<?php

namespace App\Services\Employee;

use App\Http\Requests\Admin\ChildAttendance\CreateRequest;
use App\Models\Child;
use App\Models\ChildrenAttendance;
use App\Models\Group;
use Illuminate\Support\Facades\Lang;

class ChildAttendanceService
{
    public function attendances($currentMonth){
        $attendances = Group::where('teacher_id', auth()->user()->id)->with(['child', 'attendance' => function ($query) use ($currentMonth) {
            $query->whereMonth('date', $currentMonth->month)->whereYear('date', $currentMonth->year);
        }])->first();
        return $attendances;
    }

    public function create(CreateRequest $request){
        $data = $request->validated();
        $attendance = [];
        $children = Child::where('group_id', auth()->user()->group->id)->get();
        foreach ($children as $child) {
            $attendanceKey = 'child-' . $child->id;
            if ($request->has($attendanceKey)) {
                $attendance[$child->id] = true;
            } else {
                $attendance[$child->id] = false;
            }
        }
        $attendance = json_encode($attendance);
        ChildrenAttendance::create([
            'group_id' => auth()->user()->group->id,
            'date' => $data['date'],
            'attendance' => $attendance,
        ]);

        $message = Lang::get('lang.create_attendance_success');

        return $message;
    }
}
