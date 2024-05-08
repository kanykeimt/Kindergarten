<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Child\CreateRequest;
use App\Http\Requests\Admin\Child\UpdateRequest;
use App\Models\Child;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChildService
{
    public function create(CreateRequest $request):RedirectResponse
    {
        $data = $request->validated();

        $directory = 'public/childrenImages/'.$data['group_id'];
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
        $path = 'childrenImages/'.$data['group_id'];

        $photo = '';
        $birth_cert = '';
        $med_cert = '';
        $med_disability = '';
        if(array_key_exists('photo', $data)){
            $photo = Storage::disk('public')->put($path, $data['photo']);
            $photo = "storage/".$photo;
        }
        if(array_key_exists('birth_certificate', $data)){
            $birth_cert = Storage::disk('public')->put($path, $data['birth_certificate']);
            $birth_cert = "storage/".$birth_cert;
        }
        if(array_key_exists('med_certificate', $data)){
            $med_cert = Storage::disk('public')->put($path, $data['med_certificate']);
            $med_cert = "storage/".$med_cert;
        }
        if(array_key_exists('med_disability', $data)){
            $med_disability = Storage::disk('public')->put($path, $data['med_disability']);
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

        return redirect()->back();
    }

    public function update(UpdateRequest $request, Child $child):RedirectResponse
    {
        $data = $request->validated();
        $photo = $child->photo;
        $birth_certificate = $child->birth_certificate;
        $med_certificate = $child->med_certificate;
        $med_disability = $child->med_disability;
        if(array_key_exists('photo', $data)){
            $image = Storage::disk('public')->put('childImages/photos', $data['photo']);
            $photo = "storage/".$image;
        }
        if(array_key_exists('birth_certificate', $data)){
            $image = Storage::disk('public')->put('childImages/birthCertificates', $data['birth_certificate']);
            $birth_certificate = "storage/".$image;
        }
        if(array_key_exists('med_certificate', $data)){
            $image = Storage::disk('public')->put('childImages/medCertificates', $data['med_certificate']);
            $med_certificate = "storage/".$image;
        }
        if(array_key_exists('med_disability', $data)){
            $image = Storage::disk('public')->put('childImages/meDisabilities', $data['med_disability']);
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
        return redirect()->route('admin.children.index')->with('status','Child data is Updated');
    }

}
