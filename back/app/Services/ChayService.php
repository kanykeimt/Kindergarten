<?php

namespace App\Services;

use App\Http\Requests\Chat\CreateRequest;
use App\Mail\SendWarningMessage;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class ChayService
{
    public function create(CreateRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $user = User::where('id', $data['to_user_id'])->first();
        $message = $data['message'];
        Mail::to($user->email)->send(new SendWarningMessage($message));
        Chat::create([
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $data['to_user_id'],
            'date' => date('Y-m-d H:i:s'),
            'message' => $data['message'],
        ]);
        $message = Lang::get('lang.message_delivered');
        return redirect()->back()->with('status', $message);
    }
}
