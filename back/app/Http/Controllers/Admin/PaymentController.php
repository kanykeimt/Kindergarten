<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Payment\CreateRequest;
use App\Models\Child;
use App\Models\Group;
use App\Models\Payment;
use App\Models\Question;
use App\Services\Admin\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    private PaymentService $service;
    public function __construct()
    {
        $this->service = new PaymentService();
    }

    public function index()
    {
        $monthsWithChildren = [] ;
        $current_date = now();
        for($i = 0; $i < 2; $i++){
            $monthsWithChildren[$current_date->copy()->subMonths($i)->format('n')] = $this->service->payments($current_date->copy()->subMonths($i));
        }
        return view('admin.payment.index',compact( 'monthsWithChildren'));
    }

    public function edit(Child $child)
    {
        $payment_data = $this->service->child_payment_data( $child);
        return view('admin.payment.edit',compact('payment_data', 'child'));
    }

    public function create(CreateRequest $request): RedirectResponse
    {
        return $this->service->create($request);
    }

    public function warning(Child $child)
    {
        $message_content = $this->service->message_content($child);
        return view('admin.payment.warning', compact( 'message_content', 'child'));

    }
}
