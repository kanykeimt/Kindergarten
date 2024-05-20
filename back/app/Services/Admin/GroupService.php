<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Group\CreateRequest;
use App\Http\Requests\Admin\Group\UpdateRequest;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class GroupService
{
    public function index()
    {
        $teacherIds = Role::where('name','Teacher')->pluck('id');
        $teachers = DB::table('users')
            ->leftJoin('groups', 'groups.teacher_id', '=', 'users.id')
            ->where('users.role',  $teacherIds[0])
            ->select('users.name as name', 'users.surname as surname',
                'users.id as id', 'groups.teacher_id')
            ->where('teacher_id', '=', null)
            ->get();

        return $teachers;
    }

    public function create(CreateRequest $request):RedirectResponse
    {
        $data = $request->validated();

        if (!Storage::exists('public/groupImages')) {
            Storage::makeDirectory('public/groupImages');
        }

        $image = Storage::disk('public')->put('groupImages', $data['image']);
        $image = "storage/".$image;

        Group::create([
            'name' => $data['name'],
            'teacher_id' => $request->teacher_id,
            'limit' => $data['limit'],
            'description' => $data['description'],
            'image' => $image
        ]);

        $message = Lang::get('lang.add_group_successful');
        return redirect()->route('admin.children.index')->with('success', $message);
    }

    public function show(Group $group)
    {
        return view('admin.children.show', compact('group'));
    }

    public function edit(Group $group)
    {
        $teachers = User::whereHas('role', function($query) {
            $query->where('name', 'Teacher');
        })->get();
        return $teachers;
    }

    public function update(UpdateRequest $request, Group $group):RedirectResponse
    {
        $data = $request->validated();
        DB::beginTransaction();
        if(array_key_exists('image', $data)){
            $image = Storage::disk('public')->put('groupImages', $data['image']);
            $image = "storage/".$image;
            $group->update([
                'name' => $data['name'],
                'teacher_id' => $data['teacher_id'],
                'limit' => $data['limit'],
                'description' => $data['description'],
                'image' => $image,

            ]);
        }
        else {
            $group->update([
                'name' => $data['name'],
                'teacher_id' => $data['teacher_id'],
                'limit' => $data['limit'],
                'description' => $data['description'],
            ]);
        }
        DB::commit();
        $message = Lang::get('lang.update_group_successful');
        return redirect()->route('admin.children.index')->with('success',$message);
    }

    public function delete(Group $group)
    {
        if(Group::find($group->id)->child()->exists()){
            $message = Lang::get('lang.group_del_err_mes_child');
            return redirect()->route('admin.children.index')->with('error',$message);

        }
        else {
            $user = User::find($group->teacher_id);
            DB::beginTransaction();
            $user->update([
                'role' => 3
            ]);
            DB::commit();
            $group->delete();
            $message = Lang::get('lang.delete_answer_group');
            return redirect()->route('admin.children.index')->with('success', $message);
        }
    }
}
