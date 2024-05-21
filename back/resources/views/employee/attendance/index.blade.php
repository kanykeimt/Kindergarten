@extends('layouts.employee_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="addUserBtnId" onclick="showForm()">@lang('lang.add_attendance')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <form action="{{route('employee.attendance.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-7">
                        <input type="number" class="form-control" id="group_id" value="{{auth()->user()->group->id}}" name="group_id" required autocomplete="group_id" hidden="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="date" class="col-sm-2 col-form-label">@lang('lang.date'):</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="date" name="date" required autocomplete="date" min="" max="">
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="table-sm">
                        <th class="">id</th>
                        <th class="">@lang('lang.child_name')</th>
                        <th class="">@lang('lang.child_surname')</th>
                        <th class="">
                            <div class="form-check">
                                All
                                <input class="form-check-input" type="checkbox" onclick="selectAll(this)">
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="childTable">
                    @foreach ($group->child as $index => $child)
                        <tr class=>
                            <td class="">{{$index + 1}}</td>
                            <td class="">{{$child->name}}</td>
                            <td class="">{{$child->surname}}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{'child-'.$child->id}}" name="{{'child-'.$child->id}}" >
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>


    <div class="col-sm-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">{{ \Carbon\Carbon::now()->format('F') }}</h6>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr class="table-sm">
                        <th class="">id</th>
                        <th class="">@lang('lang.full_name_child')</th>
                        @for($i = 1; $i <= \Carbon\Carbon::now()->startOfMonth()->diffInDays(\Carbon\Carbon::now()) + 1; $i++)
                            <th class="" >{{$i}}</th>
                        @endfor

                    </tr>
                    </thead>
                    <tbody id="paymentTable">
                    @foreach ($group->child as $child)
                        <tr>
                            <td>{{$child->id}}</td>
                            <td >{{$child->name}} {{$child->surname}}</td>
                            @for($i = 1; $i <= \Carbon\Carbon::now()->startOfMonth()->diffInDays(\Carbon\Carbon::now()) + 1; $i++)
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

        function selectAll(checkbox) {
            let tbody = document.querySelector('#childTable');
            let checkboxes = tbody.querySelectorAll('.form-check-input[type="checkbox"]');

            checkboxes.forEach(function(element) {
                element.checked = checkbox.checked;
            });
        }


    </script>
@endsection
