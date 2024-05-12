<?php

namespace App\Services;

use App\Http\Requests\Chat\CreateRequest;
use App\Models\Chat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;

class ChayService
{
    public function create(CreateRequest $request):RedirectResponse
    {
        $data = $request->validated();
        Chat::create([
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $data['to_user_id'],
            'date' => $data['date'],
            'message' => $data['message'],
        ]);
        $message = Lang::get('lang.message_delivered');
        return redirect()->back()->with('status', $message);
    }
}
