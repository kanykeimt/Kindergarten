<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Child\CreateRequest;
use App\Http\Requests\Employee\Child\UpdateRequest;
use App\Models\Child;
use App\Models\Group;
use App\Models\User;
use App\Services\Employee\ChildService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ChildrenController extends Controller
{
    private ChildService $service;
    public function __construct(ChildService $service){
        $this->service = $service;
    }
     public function index(){
         $children = $this->service->children();
         $parents = $this->service->parents();
         return view('employee.children.index', compact('children', 'parents'));
     }

     public function show(Child $child){
         return view('employee.children.show', compact('child'));
     }

     public function edit(Child $child){
         return view('employee.children.edit', compact('child'));
     }

    public function update(UpdateRequest $request, Child $child){
        $message = $this->service->update($request, $child);
        return redirect()->route('employee.children.index')->with('success', $message);
    }

    public function create(CreateRequest $request){
        $message = $this->service->create($request);
        return back()->with('warning', $message);
    }

    public function delete(Child $child){
        $message = $this->service->delete($child);
        return back()->with('success',$message);
    }

}
