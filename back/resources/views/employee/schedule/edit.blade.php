@extends('layouts.employee_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <form action="{{route('employee.schedule.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="group_id" class="col-sm-3 col-form-label">@lang('lang.child_group'):</label>
                    <div class="col-sm-6" hidden="">
                        <input type="text" class="form-control" id="classes_name_kg" value="{{auth()->user()->group->id}}" name="group_id" required autocomplete="group_id">
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{auth()->user()->group->name}}"  required disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="day" class="col-sm-2 col-form-label">@lang('lang.dayOfWeek'):</label>
                    <div class="col-sm-6" hidden="">
                        <input type="text" class="form-control" id="day" value="{{$day->id}}" name="day" required autocomplete="day">
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{$day->name}}"  required disabled>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr class="table-sm">
                            <th class="">@lang('lang.classes_name')</th>
                            <th class="">@lang('lang.from')</th>
                            <th class="">@lang('lang.to')</th>
                        </tr>
                        </thead>
                        <tbody id="groupTable">
                        @foreach ($schedules as $indexOfSchedule => $schedule)
                            <tr>
                                <td hidden="">
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control"  id="id-{{$indexOfSchedule}}" name="id-{{$indexOfSchedule}}" value="{{$schedule->id}}">
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select mb-3" aria-label="Default select example" id="classes_id-{{$indexOfSchedule}}" name="classes_id-{{$indexOfSchedule}}">
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}" {{$schedule->classes_id == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <div class="col-sm-8">
                                        <input type="time" class="form-control"  id="time_from-{{$indexOfSchedule}}" name="time_from-{{$indexOfSchedule}}" value="{{$schedule->time_from}}" required autocomplete="time_from">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-8">
                                        <input type="time" class="form-control" id="time_to-{{$indexOfSchedule}}" value="{{$schedule->time_to}}" name="time_to-{{$indexOfSchedule}}" required autocomplete="time_to">
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="{{route('employee.schedule.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                    <button type="submit" class="btn btn-success">@lang('lang.save_btn')</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
@endsection
