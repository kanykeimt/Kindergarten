<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function create(RegisterRequest $request){
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => Role::where('name', 'User')->first()->id,
        ]);

        return $user;
    }
}
