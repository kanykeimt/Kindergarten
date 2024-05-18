<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        $groups = Group::all();
        return view('admin.schedule.index', compact('groups'));
    }
}
