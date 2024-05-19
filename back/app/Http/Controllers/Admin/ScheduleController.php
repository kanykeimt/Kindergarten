<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\CreateRequest;
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
}
