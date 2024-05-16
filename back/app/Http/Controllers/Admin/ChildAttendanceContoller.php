<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChildAttendance\ArchiveRequest;
use App\Http\Requests\Admin\ChildAttendance\CreateRequest;
use App\Models\Attendance;
use App\Models\Child;
use App\Models\ChildrenAttendance;
use App\Models\Group;
use App\Models\User;
use App\Services\Admin\ChildAttendanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ChildAttendanceContoller extends Controller
{
    private ChildAttendanceService $service;
    public function __construct(ChildAttendanceService $service){
        $this->service = $service;
    }
    public function index(){
        $currentMonth = now()->month;

        $groupsWithChildren = Group::with(['child', 'attendance' => function ($query) use ($currentMonth) {
            $query->whereMonth('date', $currentMonth);
        }])->get();
        return view('admin.attendance.index', compact('groupsWithChildren'));
    }

    public function createForm(Request $request)
    {
        if (ChildrenAttendance::where('group_id', $request->group_id)->where('date', $request->date)->count() > 0){
            $message = Lang::get('lang.create_attendance_date_error');
            return redirect()->route('admin.attendance.index')->with('error',$message);
        }
        $children = Child::where('group_id', $request->group_id)->get();
        $group = Group::where('id', $request->group_id)->first();
        return view('admin.attendance.createForm', compact('request','children', 'group'));
    }

    public function create(CreateRequest $request)
    {
        $message = $this->service->create($request);
        return redirect()->route('admin.attendance.index')->with('success', $message);
    }

    public function archive()
    {
        $groups = Group::all();
        return view('admin.attendance.archive.index', compact('groups'));
    }

    public function archiveShow(ArchiveRequest $request){
        $attendances = $this->service->archiveShow($request);
        $date = $request->date;
        if($attendances->count() == 0){
            $message = Lang::get('lang.no_data_attendance');
            return redirect()->back()->with('warning', $message);
        }
        $data = $request->validated();
        [$year, $month] = explode('-', $data['date']);
        return view('admin.attendance.archive.show', compact('attendances','date','year', 'month'));
    }

}
