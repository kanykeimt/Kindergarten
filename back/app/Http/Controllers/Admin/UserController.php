<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\Admin\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserService $service;
    public function __construct()
    {
        $this->service = new UserService();
    }

    public function index(){
        $users = User::all();
        $roles = Role::all();
        return view('admin.user.index', compact('users', 'roles'));

    }

    public function edit(User $user){
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function create(CreateRequest $request): RedirectResponse
    {        return $this->service->create($request);
    }

    public function show(User $user):View
    {
        $role = Role::where('id', $user->role)->get();
        return view('admin.user.show',compact('user', 'role'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        return $this->service->update($request, $user);
    }

    public function delete(User $user){
        $user->delete();
        $message = Lang::get('lang.delete_answer_user');
        return redirect()->route('admin.user.index')->with('status',$message);
    }
}
