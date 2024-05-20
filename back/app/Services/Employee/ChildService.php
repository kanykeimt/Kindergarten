<?php

namespace App\Services\Employee;

use App\Http\Requests\Employee\Child\CreateRequest;
use App\Http\Requests\Employee\Child\UpdateRequest;
use App\Models\Child;
use App\Models\Enroll;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ChildService
{
    public function children(){
        $children = Child::where('group_id', Auth::user()->group->id)->get();
        return $children;
    }

    public function parents()
    {
        $parents = User::all();
        return $parents;
    }
    public function update(UpdateRequest $request, Child $child){
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
            'parent_id' => $child->parent_id,
            'group_id' => $child->group_id,
            'photo' => $photo,
            'birth_certificate' => $birth_certificate,
            'med_certificate' => $med_certificate,
            'med_disability' => $med_disability
        ]);
        DB::commit();

        return Lang::get('lang.update_child_successful');
    }

    public function create(CreateRequest $request)
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

        Enroll::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
            'parent_id' => $data['parent_id'],
            'photo' => $photo,
            'birth_certificate' => $birth_cert,
            'med_certificate' => $med_cert,
            'med_disability' => $med_disability,
        ]);

        return Lang::get('lang.add_child_warning');
    }

    public function delete(Child $child)
    {
        $child->delete();
        return Lang::get('lang.delete_answer_child');
    }
}
