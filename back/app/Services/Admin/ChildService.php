<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Child\CreateRequest;
use App\Http\Requests\Admin\Child\UpdateRequest;
use App\Models\Child;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ChildService
{
    public function index()
    {
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
        $data['children'] = $children;
        $data['parents'] = $parents;
        $data['groups'] = $groups;
        $data['amount_child_group'] = $amount_child_group;

        return $data;
    }

    public function edit(Child $child)
    {
        $user_id = Role::where('name', 'User')->first()->id;
        $parents = User::where('role', '!=', $user_id)->get();
        $groups = Group::all();
        return view('admin.children.edit', compact('child', 'parents', 'groups'));
    }

    public function show(Child $child)
    {
        return view('admin.children.show', compact('child'));
    }
    public function create(CreateRequest $request):RedirectResponse
    {
        $data = $request->validated();

        if (!Storage::exists('public/childrenImages/photos')) {
            Storage::makeDirectory('public/childrenImages/photos');
        }
        if (!Storage::exists('public/childrenImages/birthCertificates')) {
            Storage::makeDirectory('public/childrenImages/birthCertificates');
        }
        if (!Storage::exists('public/childrenImages/medCertificates')) {
            Storage::makeDirectory('public/childrenImages/medCertificates');
        }
        if (!Storage::exists('public/childrenImages/medDisabilities')) {
            Storage::makeDirectory('public/childrenImages/medDisabilities');
        }

        $photo = '';
        $birth_cert = '';
        $med_cert = '';
        $med_disability = '';

        if(array_key_exists('photo', $data)){
            $photo = Storage::disk('public')->put('childrenImages/photos', $data['photo']);
            $photo = "storage/".$photo;
        }
        if(array_key_exists('birth_certificate', $data)){
            $birth_cert = Storage::disk('public')->put('childrenImages/birthCertificates', $data['birth_certificate']);
            $birth_cert = "storage/".$birth_cert;
        }
        if(array_key_exists('med_certificate', $data)){
            $med_cert = Storage::disk('public')->put('childrenImages/medCertificates', $data['med_certificate']);
            $med_cert = "storage/".$med_cert;
        }
        if(array_key_exists('med_disability', $data)){
            $med_disability = Storage::disk('public')->put('childrenImages/medDisabilities', $data['med_disability']);
            $med_disability = "storage/".$med_disability;
        }

        $child = Child::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
            'parent_id' => $data['parent_id'],
            'group_id' => $data['group_id'],
            'photo' => $photo,
            'birth_certificate' => $birth_cert,
            'med_certificate' => $med_cert,
            'med_disability' => $med_disability,
        ]);
        $child->group_id = Group::where('id', $child->group_id)->pluck('name');

        DB::beginTransaction();
        $parent = User::where('id', $request['parent_id'])->get();
        $parent = $parent[0];

        if ($parent->role === 4)
            $parent->update([
                'role' => 3
            ]);
        $parent->update([
            'amount_of_child' => $parent->amount_of_child + 1
        ]);
        DB::commit();

        $message = Lang::get('lang.add_child_successful');
        return redirect()->back()->with('success', $message);
    }

    public function update(UpdateRequest $request, Child $child):RedirectResponse
    {
        $data = $request->validated();

        $photo = $child->photo;
        $birth_certificate = $child->birth_certificate;
        $med_certificate = $child->med_certificate;
        $med_disability = $child->med_disability;

        if(array_key_exists('photo', $data)){
            $image = Storage::disk('public')->put('childrenImages/photos', $data['photo']);
            $photo = "storage/".$image;
        }
        if(array_key_exists('birth_certificate', $data)){
            $image = Storage::disk('public')->put('childrenImages/birthCertificates', $data['birth_certificate']);
            $birth_certificate = "storage/".$image;
        }
        if(array_key_exists('med_certificate', $data)){
            $image = Storage::disk('public')->put('childrenImages/medCertificates', $data['med_certificate']);
            $med_certificate = "storage/".$image;
        }
        if(array_key_exists('med_disability', $data)){
            $image = Storage::disk('public')->put('childrenImages/meDisabilities', $data['med_disability']);
            $med_disability = "storage/".$image;
        }

        DB::beginTransaction();
        $child->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
            'parent_id' => $data['parent_id'],
            'group_id' => $data['group_id'],
            'photo' => $photo,
            'birth_certificate' => $birth_certificate,
            'med_certificate' => $med_certificate,
            'med_disability' => $med_disability
        ]);
        DB::commit();
        $message = Lang::get('lang.update_child_successful');
        return redirect()->route('admin.children.index')->with('status',$message);
    }

    public function delete(Child $child):RedirectResponse
    {
        $user_id = Role::where('name', 'User')->first()->id;
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
                'role' => $user_id
            ]);
            DB::commit();
        }
        $message = Lang::get('lang.delete_answer_child');
        return redirect()->route('admin.children.index')->with('status',$message);
    }
}
