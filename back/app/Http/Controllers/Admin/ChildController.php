<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Child\CreateRequest;
use App\Http\Requests\Admin\Child\UpdateRequest;
use App\Models\Child;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use App\Services\Admin\ChildService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ChildController extends Controller
{
    private ChildService $service;

    public function __construct(){
        $this->service = new ChildService();
    }
    public function index()
    {
        $data = $this->service->index();
        $children = $data['children'];
        $parents = $data['parents'];
        $groups = $data['groups'];
        $amount_child_group = $data['amount_child_group'];

        return view('admin.children.index', compact('children', 'parents', 'groups', 'amount_child_group'));
    }

    public function create(CreateRequest $request):RedirectResponse
    {
        return $this->service->create($request);
    }

    public function edit(Child $child)
    {
        return $this->service->edit($child);
    }

    public function show(Child $child)
    {
        return $this->service->show($child);
    }

    public function update(UpdateRequest $request, Child $child):RedirectResponse
    {
        return $this->service->update($request, $child);
    }

    public function delete(Child $child):RedirectResponse
    {
        return $this->service->delete($child);
    }
}
