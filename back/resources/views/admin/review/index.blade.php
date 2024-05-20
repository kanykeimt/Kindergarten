@extends('layouts.admin_layout')
@section('style')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:40px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
        .checked {
            color: orange;
        }
        .avatar-button {
            font-size: 1.5rem;
            text-align: center;
            overflow: visible;
            border: 0;
            background-color: transparent;
            cursor: pointer;
            margin: 0;
            padding: 0;
            bottom: 0;
        }

        .avatar-text {
            height: 90px;
            width: 90px;
            align-items: center;
            color: #fff;
            display:block;
            background-color: #673ab7;
            font-size: 2.5rem;
            border-radius: 50%;
            vertical-align: center;
            justify-content: center;
            padding: 0.9rem;
        }

    </style>
@endsection
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.list_feedbacks')</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:25%">@lang('lang.full_name')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:25%">@lang('lang.date_of_comp')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:20%">@lang('lang.feedback_grade')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.action')</th>
                    </tr>
                    </thead>
                    <tbody id="enrollTable">
                    @foreach ($reviews as $review)
                        <tr class="odd">
                            <td>{{$review->user->name}} {{$review->user->surname}}</td>
                            <td>{{\Carbon\Carbon::parse($review->created_at)->format('Y-m-d ')}}</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <span class="fa fa-star checked"></span>
                                    @else
                                        <span class="fa fa-star"></span>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                <div style="float: left; display: block; width: 50%;" class="text-center">
                                    <a href="{{route('admin.review.show', $review->id)}}"><i class="fas fa-info" title="show"></i></a>
                                </div>
                                <div style="float: left; display: block; width: 50%;" class="text-center">
                                    <form action="{{route('admin.review.delete', $review->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button id="delete_button" type="button" class="border-0 bg-transparent" onclick="deletedBtn(this)">
                                            <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                                        </button>
                                    </form>
                                </div>


                            </td>
                            {{-- td>rfed</td> --}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function deletedBtn(button){
            let text = "@lang('lang.delete_question_queue')";
            if (confirm(text) === true) {
                button.setAttribute('type', 'submit');
            } else {
                button.setAttribute('type', 'button');
            }
        }
        function searchById(value){
            let table = document.getElementById('enrollTable');
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
            let table = document.getElementById('enrollTable');
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
        function searchBySurname(value){
            let table = document.getElementById('enrollTable');
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
        function searchByParent(value){
            let table = document.getElementById('enrollTable');
            let rows = table.rows;
            let n = rows.length;
            for(let i = 0; i < n; i++){
                if(rows[i].cells[3].innerHTML.indexOf(value) === -1){
                    rows[i].className = 'd-none';
                }
                else{
                    rows[i].className = '';
                }
            }
        }
    </script>
@endsection
