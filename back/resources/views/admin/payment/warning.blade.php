@extends('layouts.admin_layout')
@section('content')

    <div class="col-12">
        <div class="d-bg-light rounded h-100 p-4" id="addUserId" >
            <form action="{{route('chat.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">@lang('lang.full_name_child'):</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control col-6" value="{{$warning_data->child_name}} {{$warning_data->child_surname}}" required disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="child_id" class="col-sm-3 col-form-label">@lang('lang.full_name_parent'):</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control col-6" value="{{$warning_data->user_name}} {{$warning_data->user_surname}}" required disabled>
                        <input type="text" class="form-control col-6" id="to_user_id" name="to_user_id" value="{{$warning_data->user_id}}" required hidden="">
                        <input type="text" class="form-control col-6" id="date" name="date" value="{{date('Y-m-d H:i:s')}}" required>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="child_id" class="col-sm-3 col-form-label">@lang('lang.message_content'):</label>
                    <div class="col-sm-7">
                        <textarea style="height: 500px;" type="text" id="message" name="message" class="form-control col-6" required>{{$message_content}}</textarea>
                    </div>
                </div>
                <button class="btn btn-secondary">@lang('lang.cancel')</button>
                <button type="submit"  class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>
    <script>
        @if(session('status')){
            alert("{{ session('status') }}");
            window.history.back();
        }
        @endif
    </script>
@endsection

