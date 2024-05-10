@extends('layouts.admin_layout')
@section('content')

    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="rounded-circle" src="{{asset($user->profile_photo)}}" alt="User profile picture" style="width:150px; height:150px;">
                </div>

                <h3 class="profile-username text-center">{{$user->name}} {{$user->surname}}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>@lang('lang.address')</b>
                        <div class="">{{$user->address}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.phone_number')</b>
                        <div class="">{{$user->phone_number}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.email')</b>
                        <div class="">{{$user->email}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.role')</b>
                        <div class="">
                            @if($user->role == 1)
                                Админ
                            @elseif($user->role == 2)
                                @lang('lang.employee')
                            @elseif($user->role == 3)
                                @lang('lang.parent')
                            @else
                                @lang('lang.user')
                            @endif
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
                    <a href="{{route('admin.user.index')}}" ><button class="btn btn-secondary">@lang('lang.back_btn')</button></a>
                </div>
            </div>
        </div>
    </div>


@endsection

