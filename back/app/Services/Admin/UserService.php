<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\User\CreateRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Child;
use App\Models\Enroll;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.user.index', compact('users', 'roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function show(User $user)
    {
        $role = Role::where('id', $user->role)->get();
        return view('admin.user.show',compact('user', 'role'));
    }
    public function create(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $passport_front = null;
        $passport_back = null;
        $profile_photo = null;

        if(array_key_exists('passport_front', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_front']);
            $passport_front = "storage/".$image;
        }
        if(array_key_exists('passport_back', $data)){
            $image = Storage::disk('public')->put('passports', $data['passport_back']);
            $passport_back = "storage/".$image;
        }
        if(array_key_exists('profile_photo', $data)){
            $profile_photo = Storage::disk('public')->put('profilePhotos', $data['profile_photo']);
            $profile_photo = "storage/".$profile_photo;
        }
        $data['password'] = Hash::make($data['password']);

        User::create([
            'name'=>$data['name'],
            'surname'=>$data['surname'],
            'address'=>$data['address'],
            'phone_number'=>$data['phone_number'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'role' => $data['role'],
            'profile_photo'=>$profile_photo,
            'passport_front'=>$passport_front,
            'passport_back'=>$passport_back
        ]);

        $message = Lang::get('lang.add_user_successful');
        return redirect()->back()->with('success', $message);
    }

    public function update(UpdateRequest $request, User $user):RedirectResponse
    {
        $data = $request->validated();
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
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
            'profile_photo' => $user->profile_photo,
            'passport_back' => $passport_back,
            'passport_front' => $passport_front
        ]);
        DB::commit();
        $message = Lang::get('lang.update_user_successful');
        return redirect()->route('admin.user.index')->with('success',$message);
    }

    public function delete(User $user):RedirectResponse
    {
        $message = '';
        if(User::find($user->id)->child()->exists()){
            $message = Lang::get('lang.user_del_err_mes_child');
            return redirect()->route('admin.user.index')->with('error',$message);
        }
        elseif(User::find($user->id)->group()->exists()){
            $message = Lang::get('lang.user_del_err_mes_group');
            return redirect()->route('admin.user.index')->with('error',$message);
        }
        if(User::find($user->id)->enroll()->exists()){
            $message = Lang::get('lang.user_del_err_mes_child');
            return redirect()->route('admin.user.index')->with('error',$message);
        }
        else{
            $user->delete();
            $message = Lang::get('lang.delete_answer_user');
            return redirect()->route('admin.user.index')->with('success',$message);
        }
    }
}
