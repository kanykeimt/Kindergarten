<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChildAttendance\ArchiveRequest;
use App\Http\Requests\Admin\ChildAttendance\CreateRequest;
use App\Http\Requests\Employee\UpdateArchiveRequest;
use App\Models\Attendance;
use App\Models\Child;
use App\Models\ChildrenAttendance;
use App\Models\Group;
use App\Services\Employee\ChildAttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ChildAttendanceController extends Controller
{
    private ChildAttendanceService $service;
    public function __construct(ChildAttendanceService $service){
        $this->service = $service;
    }
    public function index(){
        $currentMonth = now();
        $group = $this->service->attendances($currentMonth);
        return view('employee.attendance.index', compact('group'));
    }
    public function create(CreateRequest $request){
       if(ChildrenAttendance::where('group_id', auth()->user()->group->id)->where('date', $request->date)->count() > 0){
           return redirect()->route('employee.attendance.index')->with('error', Lang::get('lang.create_attendance_date_error_emp'));
       }
       else{
           $message = $this->service->create($request);
           return redirect()->route('employee.attendance.index')->with('success', $message);
       }
    }

    public function showArchive(){
        $data= [];
        for($i = 1; $i <= 3; $i++){
            $data[\Carbon\Carbon::now()->copy()->subMonths($i)->format('n')] = $this->service->attendances(\Carbon\Carbon::now()->copy()->subMonths($i));
        }
        return view('employee.attendance.archive', compact( 'data'));
    }

    public function archiveShow(ArchiveRequest $request){
        $carbonDate = Carbon::parse($request->date);
        $data[$carbonDate->month] = $this->service->attendances($carbonDate);
        return view('employee.attendance.archive', compact( 'data'));
    }
    public function editArchive(Request $request){
        $data = $request->validate([
            'date' => 'required',
        ]);
        $children = DB::table('groups')
            ->leftJoin('children', 'children.group_id', '=', 'groups.id')
            ->leftJoin('users', 'users.id', '=', 'children.parent_id')
            ->where('groups.teacher_id', auth()->user()->id)
            ->select('children.id', 'children.name', 'children.surname', 'children.birth_date', 'groups.id as group_id')
            ->get();
        $group_id = Group::where('teacher_id', auth()->user()->id)
            ->select('id')
            ->get();
        $attendance = Attendance::where('group_id', $group_id[0]->id)
            ->where('date', $data['date'])
            ->orderBy('date', 'asc')
            ->select('id','group_id','date', 'children')
            ->get();
        $attendance_array = json_decode($attendance[0]->children, true);
        $i = 0;
        foreach ($children as $child)
        {
            if(array_key_exists($child->id, $attendance_array))
                $child->attendance = $attendance_array[$child->id];
            else{
                unset($children[$i]);
            }
            $i++;
        }
        return view('employee.attendance.archiveEdit', compact('children', 'attendance'));
    }

    public function updateArchive(UpdateArchiveRequest $request, Attendance $attendance){
        $data = $request->validated();
        DB::beginTransaction();
        $attendance->update([
            'children' => $data['children']
        ]);
        DB::commit();
        return response(['status'=>'Вы успешно отметили детей']);
    }
}
