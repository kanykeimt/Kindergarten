@extends('layouts.employee_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="addUserBtnId" onclick="showForm()">@lang('lang.add_schedule')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <form action="{{route('admin.schedule.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="classes_name_kg" class="col-sm-4 col-form-label">@lang('lang.classes_name_kg'):</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="classes_name_kg" name="classes_name_kg" required autocomplete="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="classes_name_ru" class="col-sm-4 col-form-label">@lang('lang.classes_name_ru'):</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="classes_name_ru" name="classes_name_ru" required autocomplete="name">
                    </div>
                </div>
                <div class="row mb-3" hidden="">
                    <div class="col-sm-7">
                        <input type="number" class="form-control" value="{{auth()->user()->group->id}}" id="group_id" name="group_id" required autocomplete="group_id">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="day" class="col-sm-2 col-form-label">@lang('lang.dayOfWeek'):</label>
                    <div class="col-sm-8">
                        <select class="form-select mb-3" aria-label="Default select example" id="day" name="day">
                            <option value="0">@lang('lang.all')</option>
                            @foreach($daysOfWeek as $day)
                                <option value="{{$day->id}}">{{$day->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="time_from" class="col-sm-1 col-form-label">@lang('lang.from'):</label>
                    <div class="col-sm-3">
                        <input type="time" class="form-control"  id="time_from" name="time_from" required autocomplete="time_from">
                    </div>
                    <div class="col-sm-2">
                    </div>
                    <label for="time_to" class="col-sm-1 col-form-label">@lang('lang.to'):</label>
                    <div class="col-sm-3">
                        <input type="time" class="form-control"  id="time_to" name="time_to" required autocomplete="time_to">
                    </div>
                </div>

                <button type="submit" class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>

    <div class="col-12">
        <div id="addUserId" class="bg-light rounded h-100 p-4">
            <div class="table-responsive">
                <div class="col-sm-12">
                    <div class="bg-light rounded h-100 p-4">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach($daysOfWeek as $indexOfDays => $day)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{$indexOfDays == 0? 'active' : ''}}" id="pills-{{$indexOfDays}}-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-{{$indexOfDays}}" type="button" role="tab" aria-controls="pills-{{$indexOfDays}}"
                                            aria-selected="{{$indexOfDays == 0? 'true' : ''}}">{{$day->name}}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @foreach($daysOfWeek as $indexOfDays => $day)
                                <div class="tab-pane fade {{$indexOfDays == 0? 'show active' : ''}}" id="pills-{{$indexOfDays}}" role="tabpanel" aria-labelledby="pills-{{$indexOfDays}}-tab">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr class="table-sm">
                                                <th class="">@lang('lang.classes_name')</th>
                                                <th class="">@lang('lang.from')</th>
                                                <th class="">@lang('lang.to')</th>
                                                <th class="" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:10%">@lang('lang.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody id="groupTable">
                                            @foreach ($schedules as $schedule)
                                                @if($schedule->day == $day->id)
                                                    <tr>
                                                        <td>{{$schedule->class_name}}</td>
                                                        <td>{{$schedule->time_from}}</td>
                                                        <td>{{$schedule->time_to}}</td>
                                                        <td>
                                                            <div style="float: left; display: block; width: 33%;" class="text-center">
                                                                <form action="{{route('employee.schedule.delete', $schedule->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button id="delete_button" type="submit" class="border-0 bg-transparent" onclick="return deletedBtn()">
                                                                        <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{route('employee.schedule.edit',['group_id'=>auth()->user()->group->id,'day_id'=>$day->id])}}" class="btn btn-success  float-end">@lang('lang.edit_btn')</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === window.location.pathname) {
                    link.classList.add('active');
                }
            });
        });

    </script>
@endsection
