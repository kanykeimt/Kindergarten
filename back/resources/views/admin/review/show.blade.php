
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
            <div class="card-body box-profile">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>@lang('lang.full_name'):</b>
                        <div class="">{{$review->user->name}} {{$review->user->surname}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.feedback_grade'):</b>
                        <div class="">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <span class="fa fa-star checked"></span>
                                @else
                                    <span class="fa fa-star"></span>
                                @endif
                            @endfor
                        </div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.feedback_comment'):</b>
                        <div class="">{{$review->comment}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.email'):</b>
                        <div class="">{{$review->user->email}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.phone_number'):</b>
                        <div class="">{{$review->user->phone_number}}</div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="{{route('admin.review.index')}}" class="btn btn-secondary my-1">@lang('lang.back_btn')</a>
            </div>
        </div>
    </div>

@endsection

