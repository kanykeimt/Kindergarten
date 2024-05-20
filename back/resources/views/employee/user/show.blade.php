@extends('layouts.employee_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="card-body box-profile">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>@lang('lang.name'):</b>
                        <div class="">{{$user->name}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.surname'):</b>
                        <div class="">{{$user->surname}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.children'):</b>
                        @foreach($children as $child)
                            <div class="">{{$child->name}} {{$child->surname}}</div>
                        @endforeach
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.address'):</b>
                        <div class="">{{$user->address}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.phone_number'):</b>
                        <div class="">{{$user->phone_number}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.email'):</b>
                        <div class="">{{$user->email}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.profile_photo'):</b>
                        <div class="">
                            <img class="img-fluid" src="{{asset($user->profile_photo)}}" alt="User passport front" style="width:70%;">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.passport_front')</b>
                        <div class="">
                            <img class="img-fluid" src="{{asset($user->passport_front)}}" alt="User passport front" style="width:70%;">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.passport_back')</b>
                        <div class="">
                            <img class="img-fluid" src="{{asset($user->passport_back)}}" alt="User passport back" style="width:70%;">
                        </div>
                    </li>
                </ul>

                <div class="modal-footer">
                    <a href="{{route('employee.user.index')}}" ><button class="btn btn-secondary">@lang('lang.back_btn')</button></a>
                </div>
            </div>
        </div>
    </div>


@endsection

