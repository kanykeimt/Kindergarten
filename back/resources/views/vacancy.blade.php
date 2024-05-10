@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="bg-light rounded">
            <div class="row">
                <div class="wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100 d-flex flex-column justify-content-center p-5">
                        <h2 class="team-text text-center">@lang('lang.vac_msg')</h2>
                        <br>
                        <form action="{{route('vacancy.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="full_name" class="form-label">@lang('lang.full_name'):</label>
                                    <input type="text" class="form-control col-6" name="full_name" id="full_name" required>
                                    @error('full_name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="phone_number" class="form-label">@lang('lang.phone_number'):</label>
                                    <input type="text" class="form-control col-6" name="phone_number" id="phone_number" required>
                                    @error('phone_number')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row mb-3">
                                <label for="resume" class="form-label">@lang('lang.vac_cv'):</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="file" accept="image/*, .pdf, .doc, .docx" id="resume" name="resume">
                                </div>
                            </div>
                            <br>
                            @foreach($questions as $index => $question  )
                                <div class="row mb-3">
                                    <label for="answer-{{$index}}" class="form-label">{{$index+1}}) {{$question->text}}</label>
                                    <input type="text" class="form-control col-6" name="answer-{{$index}}" id="answer-{{$index}}" required>
                                </div>
                                <br>
                            @endforeach
                            <div class="modal-footer">
                                <a href="{{route('index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                                <button type="submit" class="btn btn-success">@lang('lang.save_btn')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
