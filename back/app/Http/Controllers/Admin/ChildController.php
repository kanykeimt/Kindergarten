<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Child\CreateRequest;
use App\Http\Requests\Admin\Child\UpdateRequest;
use App\Models\Child;
use App\Models\Group;
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
    public function index(){
        $children = Child::where('deleted', 0)->get();
        $parents = User::where('deleted', 0)->get();
        $groups = Group::all();
        $amount_child_group = [];
        foreach ($groups as $group){
            $count = 0;
            foreach ($children as $child){
                if($group->id === $child->group_id){
                    $count++;
                }
            }
            $amount_child_group[$group->id] = $count;
        }
        return view('admin.children.index', compact('children', 'parents', 'groups', 'amount_child_group'));
    }

    public function create(CreateRequest $request):RedirectResponse
    {
        return $this->service->create($request);
    }

    public function edit(Child $child){
        $parents = User::where('role', '!=', 4)->get();
        $groups = Group::all();
        return view('admin.children.edit', compact('child', 'parents', 'groups'));
    }

    public function show(Child $child){
        return view('admin.children.show', compact('child'));
    }

    public function update(UpdateRequest $request, Child $child):RedirectResponse
    {
        return $this->service->update($request, $child);
    }

    public function delete(Child $child){
        $parent = User::where('id', $child->parent_id)->get();
        $parent = $parent[0];
        DB::beginTransaction();
        $child->update([
            'deleted' => 1
        ]);
        $parent->update([
            'amount_of_child' => $parent->amount_of_child - 1
        ]);
        DB::commit();
        if ($parent->amount_of_child === 0){
            DB::beginTransaction();
            $parent->update([
                'role' => 4
            ]);
            DB::commit();
        }
        $message = Lang::get('lang.delete_answer_child');
        return redirect()->route('admin.children.index')->with('status',$message);
    }
}
