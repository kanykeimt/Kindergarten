<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use App\Services\Admin\IndexService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private IndexService $service;
    public function __construct(IndexService $service){
        $this->service = $service;
    }
    public function __invoke()
    {
        $chats = $this->service->chats();
        $from_user_data = User::where('id', $chats->first()->from_user_id)->first();
        $startDate = Carbon::parse($chats[0]->date);
        $currentDate = Carbon::now();

        $differenceInDays = $currentDate->diffInHours($startDate);
        return view('admin.index', compact('chats', 'from_user_data', 'differenceInDays'));
    }
}
