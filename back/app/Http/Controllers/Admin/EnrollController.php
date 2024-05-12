<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Enroll\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Child;
use App\Models\Enroll;
use App\Models\Group;
use App\Models\User;
use App\Services\Admin\EnrollService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;


class EnrollController
{
    private EnrollService $service;
    public function __construct()
    {
        $this->service = new EnrollService();
    }
    public function index()
    {
        $enrolls = Enroll::all();
        return view('admin.enroll.index', compact('enrolls'));
    }

    public function show(Enroll $enroll)
    {
        $groups = Group::all();
        $parent = User::select('name', 'surname')->where('id', $enroll->parent_id)->get();
        return view('admin.enroll.show', compact('enroll', 'groups', 'parent'));
    }

    public function approve(CreateRequest $request, Enroll $enroll):RedirectResponse
    {
        return $this->service->approve($request, $enroll);
    }

    public function delete(Enroll $enroll){
        return $this->service->delete($enroll);
    }
}
