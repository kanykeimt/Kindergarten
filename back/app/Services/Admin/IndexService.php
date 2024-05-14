<?php

namespace App\Services\Admin;

use App\Models\Chat;
use App\Models\User;

class IndexService
{
    public function chats(){
        $chats = Chat::where('to_user_id', auth()->user()->id)->get();
        return $chats;
    }
}
