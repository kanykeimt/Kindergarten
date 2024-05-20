@extends('layouts.employee_layout')
@section('content')

    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="card-body box-profile">

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>@lang('lang.child_name'):</b>
                        <div class="">{{$child->name}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_surname'):</b>
                        <div class="">{{$child->surname}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_birth_date'):</b>
                        <div class="">{{$child->birth_date}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_gender'):</b>
                        <div class="">{{$child->gender}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_parent'):</b>
                        <div class="">{{$child->parent->name}} {{$child->parent->surname}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_group'):</b>
                        <div class="">{{$child->group->name}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_photo'):</b>
                        <div class="">
                            <img class="img-fluid img" src="{{asset($child->photo)}}" alt="child's photo" style="width:70%;">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_birth_cert'):</b>
                        <div class="">
                            <img class="img-fluid img" src="{{asset($child->birth_certificate)}}" alt="child's birth certificate" style="width:70%;">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_med_cert'):</b>
                        <div class="">
                            <img class="img-fluid img" src="{{asset($child->med_certificate)}}" alt="child's medical certificate" style="width:70%;">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.child_med_dis'):</b>
                        <div class="">
                            <img class="img-fluid img" src="{{asset($child->med_disability)}}" alt="child's medical disability certificate" style="width:70%;">
                        </div>
                    </li>
                </ul>

                <div class="modal-footer">
                    <a href="{{route('employee.children.index')}}" ><button class="btn btn-secondary">@lang('lang.back_btn')</button></a>
                </div>
            </div>
        </div>
    </div>

@endsection

