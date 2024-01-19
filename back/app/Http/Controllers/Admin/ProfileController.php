<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\UpdateProfileRequest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user){
        return view('admin.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user){
        $data = $request->validated();
        DB::beginTransaction();
        $passport_back = $user->passport_back;
        $passport_front = $user->passport_front;
        $profile_photo = $user->profile_photo;
        if(array_key_exists('passport_front', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_front']);
            $passport_front = "storage/".$image;
        }
        if(array_key_exists('passport_back', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_back']);
            $passport_back = "storage/".$image;
        }
        if($request->hasFile('profile_photo')){
            $profile_photo = Storage::disk('public')->put('profile', $data['profile_photo']);
            $profile_photo = "storage/".$profile_photo;
        }
        $user->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'profile_photo' => $profile_photo,
            'passport_back' => $passport_back,
            'passport_front' => $passport_front
        ]);
        DB::commit();
        return redirect('admin/profile/'.$user->id)->with('status','Ваши данные были обновлены');
    }
    public function create(Request $request){
        $data = $request->validate([
            'child_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'payment_amount' => 'required',
        ]);

        $date_from = Carbon::createFromFormat('Y-m-d', $data['date_from']);
        $date_to = Carbon::createFromFormat('Y-m-d', $data['date_to']);
        $daysExcludingSunday = $date_from->diffInDaysFiltered(function ($date) {
            return $date->dayOfWeek !== Carbon::SUNDAY;
        }, $date_to);
        $payment_amount = $daysExcludingSunday * 250;

        if($data['payment_amount'] < $payment_amount){
            return redirect()->back()->with('status', 'Payment amount is not enough');
        }
        else{
            Payment::create([
                'child_id' => $data['child_id'],
                'date_from' => $data['date_from'],
                'date_to' => $data['date_to'],
                'payment_amount' => $data['payment_amount']
            ]);
            return redirect()->back()->with('status', 'Payment was successful');
        }
    }
}
