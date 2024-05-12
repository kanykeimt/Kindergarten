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

        return view('admin.payment.warning', compact('warning_data', 'payment', 'message_content'));

    }
}
