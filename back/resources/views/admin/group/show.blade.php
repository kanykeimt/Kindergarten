@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>@lang('lang.emp_group_name'):</b>
                            <div class="">{{$group->name}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.teacher'):</b>
                            <div class="">{{$group->teacher->name}} {{$group->teacher->surname}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.limit'):</b>
                            <div class="">{{$group->limit}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.description'):</b>
                            <div class="">{{$group->description}}</div>
                        </li>
                        <li class="list-group-item">
                            <b>@lang('lang.group_image'):</b>
                            <div class="">
                                <img class="img-fluid img" src="{{asset($group->image)}}" alt="Groups photo" style="width:70%;">
                            </div>
                        </li>
                    </ul>
                </div>
            <div class="modal-footer">
                <a href="{{route('admin.group.index')}}" class="btn btn-secondary my-1">@lang('lang.back_btn')</a>
            </div>
            </div>
        </div>

@endsection

