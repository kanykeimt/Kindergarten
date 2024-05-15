<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\ChildAttendance\ArchiveRequest;
use App\Http\Requests\Admin\ChildAttendance\CreateRequest;
use App\Models\Child;
use App\Models\ChildrenAttendance;
use App\Models\Group;
use http\Env\Request;
use Illuminate\Support\Facades\Lang;

class ChildAttendanceService
{
    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        $attendance = [];
        $children = Child::where('group_id', $data['group_id'])->get();
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
            'group_id' => $data['group_id'],
            'date' => $data['date'],
            'attendance' => $attendance,
        ]);

        $message = Lang::get('lang.create_attendance_success');

        return $message;
    }

    public function archiveShow(ArchiveRequest $request){
        $data = $request->validated();
        [$year, $month] = explode('-', $data['date']);
        if ($data['group_id'] == 0){
            $attendances = Group::with(['attendance' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year);
                $query ->whereMonth('date', $month);
            }])->get();
        }
        else{
            $attendances = ChildrenAttendance::where('group_id', $data['group_id'])
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->get();
        }
        return $attendances;
    }
}
