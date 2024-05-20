<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\CreateRequest;
use App\Http\Requests\Admin\Schedule\UpdateRequest;
use App\Models\Classes;
use App\Models\DaysOfWeek;
use App\Models\Group;
use App\Models\Schedule;
use App\Services\Admin\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private ScheduleService $service;
    public function __construct(ScheduleService $service){
        $this->service = $service;
    }
    public function index(){
        $groups = Group::all();
        $daysOfWeek = $this->service->daysOfWeek();
        $schedules = $this->service->schedules();
        return view('admin.schedule.index', compact('groups', 'daysOfWeek', 'schedules'));
    }

    public function create(CreateRequest $request){
        $message = $this->service->create($request);
        return redirect()->route('admin.schedule.index')->with('success', $message);
    }

    public function edit($group_id, $day_id){
        $schedules = $this->service->edit($group_id, $day_id);
        $daysOfWeek = $this->service->daysOfWeek();
        $group_name = Group::where('id', $group_id)->first()->name;
        $classes = Classes::all();
        return view('admin.schedule.edit', compact('schedules', 'daysOfWeek', 'classes','group_id','day_id', 'group_name'));
    }

    public function delete(Schedule $schedule){
        $schedule->delete();
        return redirect()->route('admin.schedule.index');
    }

    public function update(UpdateRequest $request){
        $message = $this->service->update($request);
        return redirect()->route('admin.schedule.index')->with('success', $message);
    }
}
