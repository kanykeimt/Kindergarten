@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">@lang('lang.edit_btn')</h3>
            <div class="container">
                <form action="{{route('admin.resume.question.update', $question->id)}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="question_kg" class="form-label">@lang('lang.question_kg'):</label>
                        <textarea class="form-control" id="question_kg" name="question_kg" style="height: 150px;" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">{{$question->question_kg}}</textarea>
                        @error('question_kg')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="question_ru" class="form-label">@lang('lang.question_ru'):</label>
                        <textarea class="form-control" id="question_ru" name="question_ru" style="height: 150px;" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">{{$question->question_ru}}</textarea>
                        @error('question_ru')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('admin.resume.question.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                        <button type="submit" class="btn btn-success">@lang('lang.save_btn')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
