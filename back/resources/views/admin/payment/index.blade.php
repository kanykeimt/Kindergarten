@extends('layouts.admin_layout')
@section('content')

    <div class="col-sm-12">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                            aria-expanded="false" aria-controls="flush-collapseTwo">
                        {{ date('F') }}
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                     aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:2%">id</th>
                                    <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:20%">@lang('lang.full_name_child')</th>
                                    <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:10%">@lang('lang.to')</th>
                                    <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:15%">@lang('lang.action')</th>
                                </tr>
                                <tr class="table-sm">
                                    <th class=""><input class="form-control form-control-sm" value="" oninput="searchById(this.value)"></th>
                                    <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                                    <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                                    <th class=""></th>
                                </tr>
                                </thead>
                                <tbody id="paymentTable">
                                @foreach ($current_month_payments as $current_month_payment)
                                    <tr>
                                        <td>{{$current_month_payment->id}}</td>
                                        <td @if(($current_month_payment->date_to) <= (date('Y-m-d'))) style="background: #FE7E7E"  @endif>{{$current_month_payment->name}} {{$current_month_payment->surname}}</td>
                                        <td @if(($current_month_payment->date_to) <= (date('Y-m-d'))) style="background: #FE7E7E"  @endif>{{$current_month_payment->date_to}}</td>
                                        <td>
                                            <div style="float: left; display: block; width: 50%;" class="text-center">
                                                <a href="{{route('admin.payment.warning', $current_month_payment->id)}}"><i style="color: #ffc107" title="@lang('lang.warning')" class="fa fa-question"></i></a>
                                            </div>
                                            <div style="float: left; display: block; width: 50%;" class="text-center">
                                                <a href="{{route('admin.payment.edit', $current_month_payment->child_id)}}" class="text-success"><i title="@lang('lang.add_payment')" class="fas fa-plus"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                            aria-expanded="false" aria-controls="flush-collapseThree">
                        Accordion Item #3
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse"
                     aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        Sea sea sit sanctus magna gubergren kasd, magna justo ea lorem lorem. Elitr aliquyam ipsum clita consetetur duo at nonumy invidunt, invidunt eos dolore vero sit amet amet magna tempor clita, takimata diam justo stet erat et vero erat. Sit ipsum eirmod sea ut vero dolores sea clita nonumy, no.
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function searchById(value){
            let table = document.getElementById('paymentTable');
            let rows = table.rows;
            let n = rows.length;
            for(let i = 0; i < n; i++){
                if(rows[i].cells[0].innerHTML.indexOf(value) === -1){
                    rows[i].className = 'd-none';
                }
                else{
                    rows[i].className = '';
                }
            }
        }
        function searchByName(value){
            let table = document.getElementById('');
            let rows = table.rows;
            let n = rows.length;
            for(let i = 0; i < n; i++){
                if(rows[i].cells[1].innerHTML.indexOf(value) === -1){
                    rows[i].className = 'd-none';
                }
                else{
                    rows[i].className = '';
                }
            }
        }
        function searchByDate(value){
            let table = document.getElementById('table');
            let rows = table.rows;
            let n = rows.length;
            for(let i = 0; i < n; i++){
                if(rows[i].cells[2].innerHTML.indexOf(value) === -1){
                    rows[i].className = 'd-none';
                }
                else{
                    rows[i].className = '';
                }
            }
        }
    </script>
@endsection

