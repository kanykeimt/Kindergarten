@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="card-body box-profile">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>@lang('lang.full_name'):</b>
                        <div class="">{{$resume->full_name}}</div>
                    </li>
                    <li class="list-group-item">
                        <b>@lang('lang.phone_number')</b>
                        <div class="">{{$resume->phone_number}}</div>
                    </li>

                    <li class="list-group-item">
                        <b>CV:</b>
                        <div class="">
                            <iframe src="{{ asset($resume->resume) }}" width="100%" height="500px"></iframe>
                        </div>

                    </li>
                </ul>

                <ul class="list-group list-group-unbordered mb-3">
                    @foreach($questions as $question)
                        <li class="list-group-item">
                            <b>{{$question->text}}:</b>
                            <div class="">{{$answers[$question->id]}}</div>
                        </li>
                    @endforeach
                </ul>
                <div class="modal-footer">
                    <a href="{{route('admin.resume.index')}}" ><button class="btn btn-secondary">@lang('lang.back_btn')</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
