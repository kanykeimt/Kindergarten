<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Employee\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $service;
    public function __construct(UserService $service){
        $this->service = $service;
    }
    public function index(){
        $parents = $this->service->parents();
        return view('employee.user.index', compact('parents'));
    }

    public function show(User $user){
        $children = $this->service->children($user);
        return view('employee.user.show', compact('user', 'children'));
    }
}
