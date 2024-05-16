@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div id="addUserId" class="bg-light rounded h-100 p-4">
            <form action="{{route('admin.attendance.archiveShow')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="group_id" class="col-sm-3 col-form-label">@lang('lang.child_group'):</label>
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
                    <label for="date" class="col-sm-2 col-form-label">@lang('lang.date'):</label>
                    <div class="col-sm-8">
                        <input type="month" class="form-control" id="date" name="date" required autocomplete="date" min="" max="">
                    </div>
                </div>

                <button type="submit" class="btn btn-secondary" href="">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.next_btn')</button>
            </form>
        </div>
    </div>




@endsection
