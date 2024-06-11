<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Payment\CreateRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\DaysOfWeek;
use App\Models\Media;
use App\Services\IndexService;
use App\Services\User\ChildService;
use Illuminate\Http\Request;
use App\Models\Child;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Sodium\add;

class ChildController extends Controller
{
    private ChildService $service;
    private IndexService $indexService;
    public function __construct(ChildService $service, IndexService $indexService){
        $this->service = $service;
        $this->indexService = $indexService;
    }
    public function index(Child $child){
        $dates = $this->service->dates($child);
        $news = $this->service->news($child);
        $reviews = $this->indexService->reviews();
        $schedules =  $this->service->schedules($child);
        $daysOfWeek = $this->service->dayOfWeek();
        $colorNames = [
            "sky",
            "orange",
            "green",
            "yellow",
            "pink",
            "purple",
            "lightred",
            "blue",
            "red",
            "teal",
            "cyan",
            "lime",
            "amber"
        ];
        $hours = [];
        for ($i = 8; $i <= 18; $i++) {
            $hour = sprintf("%02d:00", $i);
            $hours[] = $hour;
        }
        return view('user.children', compact('child', 'dates', 'news', 'reviews', 'schedules', 'daysOfWeek', 'colorNames', 'hours'));

    }

    public function update(UpdateChildRequest $request, Child $child){
        $message = $this->service->update($request, $child);
        return redirect()->back()->with('success', $message);
    }

    public function payment(CreateRequest $request){
        $message = $this->service->payment($request);
        return redirect()->back()->with('success', $message);
    }

}
