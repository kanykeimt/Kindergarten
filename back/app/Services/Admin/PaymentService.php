<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Payment\CreateRequest;
use App\Models\Child;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;

class PaymentService
{

    public function current_month_data()
    {
        $current_month = date('n');
        $current_month_payments = Payment::join('children', 'payments.child_id', '=', 'children.id')
            ->select('payments.*', 'children.name', 'children.surname')
            ->whereMonth('date_from', $current_month)
            ->get();
        return $current_month_payments;
    }

    public function previous_month_data()
    {
        $previous_month = date('n') - 1;

        $previous_month_payments = Payment::join('children', 'payments.child_id', '=', 'children.id')
            ->select('payments.*', 'children.name', 'children.surname')
            ->whereMonth('date_from', $previous_month)
            ->get();
        return $previous_month_payments;
    }

    public function child_payment_data(Child $child)
    {
        $payment_data = Payment::where('child_id', $child->id)
            ->latest('created_at')
            ->first();
        return $payment_data;
    }

    public function warning_data(Payment $payment)
    {
        $data = Child::join('users', 'children.parent_id', '=', 'users.id')
            ->select('users.id as user_id', 'users.name as user_name', 'users.surname as user_surname','children.name as child_name','children.surname as child_surname')
            ->where('children.id', $payment->child_id)
            ->get();
        $data = $data[0];
        return $data;
    }
    public function create(CreateRequest $request):RedirectResponse
    {
        $data = $request->validated();
        Payment::create([
            'child_id' => $data['child_id'],
            'date_from' => $data['date_from'],
            'date_to' => $data['date_to'],
            'payment_amount' => $data['payment_amount'],
        ]);
        $message = Lang::get('lang.add_payment_successful');
        return redirect()->route('admin.payment.index')->with('status', $message);
    }
}
