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
        $current_month_payments = $this->service->current_month_data();
        $previous_month_payments = $this->service->previous_month_data();
        return view('admin.payment.index',compact('current_month_payments'));
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

    public function warning(Payment $payment)
    {
        $warning_data = $this->service->warning_data($payment);
        $message_content = $this->service->message_content($payment, $warning_data);

        return view('admin.payment.warning', compact('warning_data', 'payment', 'message_content'));

    }
}
