<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\CreateRequest;
use App\Http\Requests\Admin\Schedule\UpdateRequest;
use App\Models\Classes;
use App\Models\DaysOfWeek;
use App\Models\Group;
use App\Models\Schedule;
use App\Services\Employee\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private ScheduleService $service;
    public function __construct(ScheduleService $service){
        $this->service = $service;
    }

    public function index(){
        $daysOfWeek = $this->service->daysOfWeek();
        $schedules = $this->service->schedules();
        return view('employee.schedule.index', compact( 'daysOfWeek', 'schedules'));
    }

    public function create(CreateRequest $request){
        $message = $this->service->create($request);
        return redirect()->route('employee.schedule.index')->with('success', $message);
    }

    public function edit($group_id, $day_id){
        $schedules = $this->service->edit($group_id, $day_id);
        $day = DaysOfWeek::where('id', $day_id)->first();
        $classes = Classes::all();
        return view('employee.schedule.edit', compact('schedules', 'day', 'classes'));
    }

    public function delete(Schedule $schedule){
        $schedule->delete();
        return redirect()->route('employee.schedule.index');
    }

    public function update(UpdateRequest $request){
        $message = $this->service->update($request);
        return redirect()->route('employee.schedule.index')->with('success', $message);
    }

}
