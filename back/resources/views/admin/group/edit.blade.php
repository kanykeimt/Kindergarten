@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">@lang('lang.edit_btn')</h3>
            <div class="container">
                <form action="{{route('admin.children.update', $group->id)}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.emp_group_name'):</label>
                        <input type="text" class="form-control col-6" name="name" id="name" value="{{$group->name}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.teacher'):</label>
                        <select class="form-control col-6" name="teacher_id" id="teacher_id" @error('teacher_id') is-invalid @enderror required autocomplete="teacher_id">
                            <option></option>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" {{$teacher->id === $group->teacher_id ? "selected" : ""}}>{{$teacher->name}} {{$teacher->surname}}</option>
                            @endforeach
                        </select>                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.limit'):</label>
                        <input type="number" class="form-control col-6" name="limit" id="limit" value="{{$group->limit}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                        @error('limit')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.description'):</label>
                        <textarea class="form-control" id="description" name="description" style="height: 150px;" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">{{$group->description}}</textarea>
                        @error('description')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputFile" class="form-label">@lang('lang.group_image'):</label>
                        <div class="col-sm-6">
                            <img class="img-fluid mb-3" src="{{asset($group->image)}}"  alt="image" style="width:100%;">
                        </div>

                        <input type="file" class="form-control col-6" accept="image/png, image/gif, image/jpeg" name="image" id="image">
                        @error('passport_front')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="modal-footer">
                        <a href="{{route('admin.children.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                        <button type="submit" class="btn btn-success">@lang('lang.save_btn')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
