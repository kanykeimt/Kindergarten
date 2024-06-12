<?php

namespace App\Services;

use App\Http\Requests\EnrollCreateRequest;
use App\Models\Enroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class EnrollService
{
    public function store(EnrollCreateRequest $request)
    {
        $data = $request->validated();
        $user = User::where('id', $data['parent_id'])->first();
        DB::beginTransaction();
        $passport_back = $user->passport_back;
        $passport_front = $user->passport_front;
        if(array_key_exists('passport_front', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_front']);
            $passport_front = "storage/".$image;
        }
        if(array_key_exists('passport_back', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_back']);
            $passport_back = "storage/".$image;
        }
        $user->update([
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'passport_back' => $passport_back,
            'passport_front' => $passport_front,
        ]);
        DB::commit();

        $photo = Storage::disk('public')->put('enrollImages/photos', $data['photo']);
        $photo = "storage/".$photo;
        $birth_cert = Storage::disk('public')->put('enrollImages/birthCertificates', $data['birth_certificate']);
        $birth_cert = "storage/".$birth_cert;
        $med_cert = Storage::disk('public')->put('enrollImages/medCertificates', $data['med_certificate']);
        $med_cert = "storage/".$med_cert;
        $med_dis = '';
        if(array_key_exists('med_disability', $data)){
            $med_dis = Storage::disk('public')->put('enrollImages/medDisability', $data['med_disability']);
            $med_dis = "storage/".$med_dis;
        }


        $enroll = Enroll::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
            'parent_id' => $user->id,
            'photo' => $photo,
            'birth_certificate' => $birth_cert,
            'med_certificate' => $med_cert,
            'med_disability' => $med_dis,
        ]);
        $message = Lang::get('lang.child_added_queue');
        return back()->with('success', $message);
    }
}
