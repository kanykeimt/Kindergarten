@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="addUserBtnId" onclick="showForm()">@lang('lang.add_news')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <form action="{{route('admin.news.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="group_id" class="col-sm-3 col-form-label">@lang('lang.emp_group_name'):</label>
                    <div class="col-sm-7">
                        <select class="form-select mb-3" aria-label="Default select example" id="group_id" name="group_id">
                            <option value="0">@lang('lang.all')</option>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="media" class="col-sm-2 col-form-label">Медиа:</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" accept="image/*" id="media" name="media" multiple required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="text" class="col-sm-2 col-form-label">Текст:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="text" name="text" style="height: 150px;"></textarea>
                    </div>
                </div>


                <button class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>
@endsection
