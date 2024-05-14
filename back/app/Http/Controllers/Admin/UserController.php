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

    public function index()
    {
        return $this->service->index();
    }

    public function edit(User $user)
    {
        return $this->service->edit($user);
    }

    public function create(CreateRequest $request): RedirectResponse
    {
        return $this->service->create($request);
    }

    public function show(User $user):View
    {
        return $this->service->show($user);
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        return $this->service->update($request, $user);
    }

    public function delete(User $user):RedirectResponse
    {
        return $this->service->delete($user);
    }
}
