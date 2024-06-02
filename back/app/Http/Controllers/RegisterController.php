<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\SendCode;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    private RegisterService $service;
    public function __construct(RegisterService $service){
        $this->service = $service;
    }
    public function form(){
        return view('register');
    }
    public function register(RegisterRequest $request){
        $user = $this->service->create($request);
        $code = random_int(100000, 999999);
        Mail::to($user->email)->send(new SendCode($code));
        Session::put('code', $code);
        return redirect()->route('verification.form', $user->id);
    }
}
