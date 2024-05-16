<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\UpdateRequest;
use App\Http\Requests\Admin\Group\CreateRequest;
use App\Models\Media;
use App\Models\Group;
use App\Services\Admin\GroupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;


class GroupController extends Controller
{
    private GroupService $service;

    public function __construct()
    {
        $this->service = new GroupService();
    }
    public function index(){
        $groups = Group::all();
        $teachers = $this->service->index();
        return view('admin.group.index', compact('groups', 'teachers'));
    }

    public function create(CreateRequest $request):RedirectResponse
    {
        return $this->service->create($request);
    }

    public function show(Group $group)
    {
        return $this->service->show($group);
    }

    public function edit(Group $group){
        $teachers = $this->service->edit($group);
        return view('admin.group.edit',compact('group', 'teachers'));
    }

    public function update(UpdateRequest $request, Group $group):RedirectResponse
    {
        return $this->service->update($request, $group);
    }

    public function delete(Group $group)
    {
        return $this->service->delete($group);
    }

}
