<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Payment\CreateRequest;
use App\Models\Child;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class PaymentService
{


    public function payments($date){
        $children = Child::all()->sortBy('name');
        $month = $date->month;
        $year = $date->year;
        foreach($children as $child){
            $child->payment = $child->payment()->whereMonth('date_from', $month)->whereYear('date_from', $year)->first();
        }
        return $children;
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

    public function message_content($payment, $warning_data){
        $dateToFormatted = Carbon::parse($payment->date_to)->format('d-m-Y');
        $message_content = '';
        $lang = app()->getLocale();
        if ($lang == 'kg'){
            $message_content = "Урматтуу ата-энелер,

Бул кат менен бала бакчага акча төлөө зарылдыгын эскертебиз. Биздин шарттарга ылайык, төлөм [{$dateToFormatted}] чейин кабыл алынышы керек.

Көрсөтүлгөн мөөнөткө чейин төлөөнү суранабыз. Төлөө убагында аткарылбаса, балаңыздын ({$warning_data->child_name} {$warning_data->child_surname}) бала бакчанын иш-чараларына катышуусу токтотулушу мүмкүн экенин эскертебиз.

Эгерде сизде кандайдыр бир суроолор же кыйынчылыктар болсо, жардам алуу үчүн биздин администратор менен байланышуудан тартынбаңыз.

Көңүл бурганыңыз жана түшүнгөнүңүз үчүн рахмат.

Урматтоо менен, бала бакчанын администрациясы.";
        }
        elseif ($lang == 'ru'){
            $message_content = "Уважаемые родители,

Настоящим письмом мы хотели бы напомнить Вам о необходимости оплаты за детский сад. В соответствии с нашими положениями и условиями, оплата должна быть произведена до [{$dateToFormatted}].

Просим вас оплатить до указанного срока. Пожалуйста, примите во внимание, что невыполнение оплаты может повлечь за собой приостановку участия вашего ребенка ({$warning_data->child_name} {$warning_data->child_surname}) в деятельности детского сада.

Если у вас возникли какие-либо вопросы или затруднения, не стесняйтесь обращаться к нашему администратору для получения помощи.

Спасибо за ваше внимание и понимание.

С уважением, администрация детского сада.";
        }

        return $message_content;
    }
    public function create(CreateRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $payment = Payment::where('date_to', $data['date_from'])
            ->where('child_id', $data['child_id'])
            ->first();
        if($payment !== null){
            DB::beginTransaction();
            $payment->update([
                'date_to' => $data['date_to'],
                'payment_amount' => $payment->payment_amount + $data['payment_amount'],
            ]);
            DB::commit();
        }
        else{
            Payment::create([
                'child_id' => $data['child_id'],
                'date_from' => $data['date_from'],
                'date_to' => $data['date_to'],
                'payment_amount' => $data['payment_amount'],
            ]);
        }
        $message = Lang::get('lang.add_payment_successful');
        return redirect()->route('admin.payment.index')->with('success', $message);
    }
}
