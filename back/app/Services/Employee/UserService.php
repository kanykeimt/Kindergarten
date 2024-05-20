<?php

namespace App\Services\Employee;

use App\Models\Child;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function parents(){
        $group = Group::where('teacher_id', Auth::user()->id)
            ->with('child.parent')
            ->first();

        $parents = $group->child->pluck('parent')->unique('id');

        return $parents;
    }

    public function children(User $user){
        $children = Child::where('parent_id', $user->id)
            ->where('group_id', Auth::user()->group->id)
            ->select('name', 'surname')
            ->get();

        return $children;
    }

}
