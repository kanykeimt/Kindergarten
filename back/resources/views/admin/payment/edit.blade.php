@extends('layouts.admin_layout')
@section('content')

        <div class="col-12">
            <div id="addUserId" class="bg-light rounded h-100 p-4">
                <form action="{{route('admin.payment.create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="child_id" class="col-sm-3 col-form-label">@lang('lang.full_name_child'):</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control col-6" value="{{$child->name}} {{$child->surname}}" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3" hidden="">
                        <div class="col-sm-7">
                            <input type="text" class="form-control col-6" name="child_id" id="child_id" value="{{$child->id}}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="date_from" class="col-sm-2 col-form-label">@lang('lang.from'):</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="date_from" name="date_from" value="{{$payment_data != null ? $payment_data->date_to : ''}}" required autocomplete="date_from">
                        </div>
                    </div>
                    <div class="row mb-3" hidden="">
                        <label for="date_to" class="col-sm-2 col-form-label">@lang('lang.to'):</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" value="" id="date_to" name="date_to" required autocomplete="date_to">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="payment_amount" class="col-sm-2 col-form-label">@lang('lang.payment_amount'):</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="payment_amount" name="payment_amount" required autocomplete="payment_amount">
                        </div>
                    </div>
                    <a href="{{route('admin.payment.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                    <button type="button" onclick="approveBtn(this)" class="btn btn-success">@lang('lang.saveBtn')</button>
                </form>
            </div>
        </div>
    <script>
        function approveBtn(button){
            let date_from = document.getElementById('date_from').value;
            let payment_amount = document.getElementById('payment_amount').value;
            let days = Math.round(payment_amount/270);
            date_from = new Date(date_from);
            let daysExcludingSundays = 0;
            while (daysExcludingSundays < days) {
                if (date_from.getDay() !== 0) {
                    daysExcludingSundays++;
                }
                date_from.setDate(date_from.getDate() + 1);
            }
            let date_to = date_from.toISOString().slice(0, 10);

            if (confirm("@lang('lang.question_for_payment_date1')"+date_to+"@lang('lang.question_for_payment_date2')") === true) {
                button.setAttribute('type', 'submit');
                document.getElementById('date_to').value = date_to;
            } else {
                button.setAttribute('type', 'button')
            }
        }
    </script>
@endsection

