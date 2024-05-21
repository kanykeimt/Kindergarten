@extends('layouts.employee_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="addUserBtnId" onclick="showForm()">@lang('lang.archive_show')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <form action="{{route('employee.attendance.archiveShow')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3" hidden="">
                    <label for="group_id" class="col-sm-3 col-form-label">@lang('lang.child_group'):</label>
                    <div class="col-sm-7">
                        <input type="id" class="form-control" value="{{auth()->user()->group->id}}" id="group_id" name="group_id" required autocomplete="group_id">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="date" class="col-sm-4 col-form-label">@lang('lang.select_month_to_view'):</label>
                    <div class="col-sm-6">
                        <input type="month" class="form-control" id="date" name="date" required autocomplete="date" min="" max="">
                    </div>
                </div>

                <button class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.next_btn')</button>
            </form>
        </div>
    </div>


    @foreach($data as $index => $group)
        <div class="col-sm-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{$index}}">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$index}}"
                                aria-expanded="false" aria-controls="flush-collapse{{$index}}">
                            {{\Carbon\Carbon::create()->month($index)->format('F')}}
                        </button>
                    </h2>
                    <div id="flush-collapse{{$index}}" class="accordion-collapse collapse"
                         aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="table-sm">
                                        <th class="">id</th>
                                        <th class="">@lang('lang.full_name_child')</th>
                                        @php
                                            $currentYear = \Carbon\Carbon::now()->year;
                                            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $index, $currentYear);
                                        @endphp
                                        @for($i = 1; $i <= $daysInMonth; $i++)
                                            <th class="" >{{$i}}</th>
                                        @endfor

                                    </tr>
                                    </thead>
                                    <tbody id="paymentTable">
                                    @foreach ($group->child as $child)
                                        <tr>
                                            <td>{{$child->id}}</td>
                                            <td >{{$child->name}} {{$child->surname}}</td>
                                            @for($i = 1; $i <= $daysInMonth; $i++)
                                                @php $attendanceFound = false; @endphp
                                                @foreach($group->attendance as $attendance)
                                                    @if((date('j', strtotime($attendance->date)) == $i))
                                                        @php $attendanceFound = true; $attendances = (json_decode($attendance->attendance, true)) @endphp
                                                        @if(array_key_exists($child->id, $attendances))
                                                            @if($attendances[$child->id])
                                                                <th> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked disabled></th>
                                                            @elseif($attendances[$child->id] == false)
                                                                <th> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled></th>
                                                            @endif

                                                        @else
                                                            <th></th>
                                                        @endif
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if (!$attendanceFound)
                                                    <th></th>
                                                @endif
                                            @endfor
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
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
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Get the date input element
            let dateInput = document.getElementById('date');

            // Add event listener to the date input
            dateInput.addEventListener('input', function() {
                // Get the selected date
                let selectedDate = new Date(this.value);

                // Check if the selected date is a Sunday (day 0)
                if (selectedDate.getDay() === 0) {
                    // If it's a Sunday, reset the value to the first day of the current month
                    let today = new Date();
                    let firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                    this.value = formatDate(firstDayOfMonth);
                    // Optionally, you can alert the user or display a message
                    alert('@lang('lang.select_sunday_error')');
                }
            });

            // Function to format the date as "YYYY-MM-DD"
            function formatDate(date) {
                let year = date.getFullYear();
                let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Adding leading zero if needed
                let day = date.getDate().toString().padStart(2, '0'); // Adding leading zero if needed
                return `${year}-${month}-${day}`;
            }
        });
    </script>
@endsection
