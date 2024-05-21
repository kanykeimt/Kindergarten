@extends('layouts.admin_layout')
@section('content')

    @foreach($payments as $indexOfMonth => $payment)
        <div class="col-sm-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading-{{$indexOfMonth}}">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{$indexOfMonth}}"
                                aria-expanded="false" aria-controls="flush-collapse-{{$indexOfMonth}}">
                            {{\Carbon\Carbon::create()->month($indexOfMonth)->format('F')}}
                        </button>
                    </h2>
                    <div id="flush-collapse-{{$indexOfMonth}}" class="accordion-collapse collapse"
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
                                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByDate(this.value)"></th>
                                        <th class=""></th>
                                    </tr>
                                    </thead>
                                    <tbody id="paymentTable">
                                    @foreach ($payment as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td @if(($data->date_to) <= (date('Y-'.\Carbon\Carbon::create()->month($indexOfMonth)->format('m').'-d'))) style="background: #FE7E7E"  @endif>{{$data->child->name}} {{$data->child->surname}}</td>
                                            <td @if(($data->date_to) <= (date('Y-'.\Carbon\Carbon::create()->month($indexOfMonth)->format('m').'-d'))) style="background: #FE7E7E"  @endif>{{$data->date_to}}</td>
                                            <td>
                                                <div style="float: left; display: block; width: 50%;" class="text-center">
                                                    <a href="{{route('admin.payment.warning', $data->id)}}"><i style="color: #ffc107" title="@lang('lang.warning')" class="fa fa-question"></i></a>
                                                </div>
                                                <div style="float: left; display: block; width: 50%;" class="text-center">
                                                    <a href="{{route('admin.payment.edit', $data->child->id)}}" class="text-success"><i title="@lang('lang.add_payment')" class="fas fa-plus"></i></a>
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
    @endforeach

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
            let table = document.getElementById('paymentTable');
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
            let table = document.getElementById('paymentTable');
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

