@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="card-body box-profile">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>@lang('lang.question_kg'):</b>
                        <div class="">{{$question->question_kg}}</div>
                    </li>
                    <br>
                    <li class="list-group-item">
                        <b>@lang('lang.question_ru'):</b>
                        <div class="">{{$question->question_ru}}</div>
                    </li>
                </ul>

                <div class="modal-footer">
                    <a href="{{route('admin.resume.question.index')}}" ><button class="btn btn-secondary">@lang('lang.back_btn')</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
