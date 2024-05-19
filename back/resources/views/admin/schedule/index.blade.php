@extends('layouts.admin_layout')
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


    @foreach($groups as $index => $group)
        <div class="col-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{$index}}">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$index}}"
                                aria-expanded="false" aria-controls="flush-collapse{{$index}}">
                            {{$group->name}}
                        </button>
                    </h2>
                    <div id="flush-collapse{{$index}}" class="accordion-collapse collapse"
                         aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <div class="col-sm-12">
                                    <div class="bg-light rounded h-100 p-4">
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            @foreach($daysOfWeek as $indexOfDays => $day)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{$indexOfDays == 0? 'active' : ''}}" id="pills-{{$index}}-{{$indexOfDays}}-tab" data-bs-toggle="pill"
                                                            data-bs-target="#pills-{{$index}}-{{$indexOfDays}}" type="button" role="tab" aria-controls="pills-{{$index}}-{{$indexOfDays}}"
                                                            aria-selected="{{$indexOfDays == 0? 'true' : ''}}">{{$day->name}}</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            @foreach($daysOfWeek as $indexOfDays => $day)
                                                <div class="tab-pane fade {{$indexOfDays == 0? 'show active' : ''}}" id="pills-{{$index}}-{{$indexOfDays}}" role="tabpanel" aria-labelledby="pills-{{$index}}-{{$indexOfDays}}-tab">
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
                                                            @foreach ($schedules as $schedule)
                                                                @if($schedule->group_id == $group->id && $schedule->day == $day->id)
                                                                    <tr>
                                                                        <td>{{$schedule->class_name}}</td>
                                                                        <td>{{$schedule->time_from}}</td>
                                                                        <td>{{$schedule->time_to}}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <a href="{{route('admin.schedule.edit',['group_id'=>$group->id,'day_id'=>$day->id])}}" class="text-success float-end"><i class="fas fa-pen me-2"></i></a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
