<?php

namespace App\Services\User;

use App\Http\Requests\Admin\Payment\CreateRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Models\Child;
use App\Models\DaysOfWeek;
use App\Models\News;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ChildService
{
    public function dates($child){
        $dates = News::select(DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"),'text')
            ->where('group_id', $child->group->id)
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();

        return $dates;
    }

    public function news($child){
        $news = News::with('media', 'group')
            ->select(
                DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"),
                'media_id',
                'text',
                DB::raw('COUNT(*) as count'),
                DB::raw('CASE WHEN COUNT(*) = 1 THEN MAX(group_id) ELSE NULL END AS group_id')
            )
            ->where('group_id', $child->group->id)
            ->groupBy('datetime', 'media_id', 'text')
            ->get();

        return $news;
    }

    public function update(UpdateChildRequest $request, Child $child){
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

    public function payment(CreateRequest $request){
        $data = $request->validated();

        $payment = Payment::where('date_to', $data['date_from'])
            ->where('child_id', $data['child_id'])
            ->first();
        if($payment !== null){
            DB::beginTransaction();
            $payment->update([
                'date_to' => $data['date_to'],
                'payment_amount' => $payment->payment_amount + $data['payment_amount'],
            ]);
            DB::commit();
        }
        else{
            Payment::create([
                'child_id' => $data['child_id'],
                'date_from' => $data['date_from'],
                'date_to' => $data['date_to'],
                'payment_amount' => $data['payment_amount'],
            ]);
        }
        return Lang::get('lang.add_payment_successful');
    }

    public function schedules(Child $child){
        $schedules = Schedule::where('group_id', $child->group->id)->get();
        foreach ($schedules as $schedule) {
            $schedule->class_name = $schedule->class->name;
        }
        $schedules = $schedules->sortBy([
            ['day', 'asc'],
            ['time_from', 'asc']
        ]);
        return $schedules;
    }

    public function dayOfWeek(){
        $dayOfWeek = DaysOfWeek::all();

        foreach ($dayOfWeek as $day) {
            $day->name = $day->name;
        }

        return $dayOfWeek;
    }
}
