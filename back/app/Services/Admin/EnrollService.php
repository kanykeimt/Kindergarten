<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Enroll\CreateRequest;
use App\Models\Child;
use App\Models\Enroll;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class EnrollService
{
    public function approve(CreateRequest $request, Enroll $enroll):RedirectResponse
    {
        Child::create([
            'name'=>$enroll['name'],
            'surname' => $enroll['surname'],
            'birth_date' => $enroll['birth_date'],
            'gender' => $enroll['gender'],
            'parent_id' => $enroll['parent_id'],
            'group_id'=>$request->group_id,
            'photo' => $enroll['photo'],
            'birth_certificate' => $enroll['birth_certificate'],
            'med_certificate' => $enroll['med_certificate'],
            'med_disability' => $enroll['med_disability'],
        ]);

        DB::beginTransaction();
        $parent = User::where('id', $enroll['parent_id'])->get();
        $parent = $parent[0];
        if ($parent->role === 4)
            $parent->update([
                'role' => 3
            ]);
        $parent->update([
            'amount_of_child' => $parent->amount_of_child + 1
        ]);
        DB::commit();
        $enroll->delete();
        $message = Lang::get('lang.add_child_successful');

        return redirect()->route('admin.enroll.index')->with('status', $message);
    }


    public function delete(Enroll $enroll)
    {
        $enroll->delete();
        $message = Lang::get('lang.delete_answer_queue');
        return redirect()->route('admin.enroll.index')->with('status', $message);
    }
}
