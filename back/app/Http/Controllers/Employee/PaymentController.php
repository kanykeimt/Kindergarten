<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Payment\CreateRequest;
use App\Models\Child;
use App\Models\Payment;
use App\Services\Employee\PaymentService;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    private PaymentService $service;
    public function __construct(PaymentService $service){
        $this->service = $service;
    }

    public function index(){
        $monthsWithChildren = [] ;
        $current_date = now();
        for($i = 0; $i < 2; $i++){
            $monthsWithChildren[$current_date->copy()->subMonths($i)->format('n')] = $this->service->payments($current_date->copy()->subMonths($i));
        }
        return view('employee.payment.index',compact('monthsWithChildren'));
    }

    public function warning(Payment $payment)
    {
        $warning_data = $this->service->warning_data($payment);
        $message_content = $this->service->message_content($payment, $warning_data);

        return view('employee.payment.warning', compact('warning_data', 'payment', 'message_content'));

    }
    public function edit(Child $child)
    {
        $payment_data = $this->service->child_payment_data( $child);
        return view('employee.payment.edit',compact('payment_data', 'child'));
    }
    public function create(CreateRequest $request): RedirectResponse
    {
        return $this->service->create($request);
    }
}
