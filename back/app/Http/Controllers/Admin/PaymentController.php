<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Group;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(){
        $children = DB::table('children')
            ->leftJoin('groups', 'groups.id', '=', 'children.group_id')
            ->select('children.id', 'children.name', 'children.surname', 'groups.name as group_name')
            ->get();
        $payment = DB::table('payments')
            ->orderBy('id', 'desc')
            ->select('child_id', 'payment_amount', 'date_from', 'date_to')
            ->get();

        return view('admin.payment.index',compact('children', 'payment'));
    }


}
