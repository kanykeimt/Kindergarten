@extends('layouts.admin_layout')


@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="addUserBtnId" onclick="showForm()">@lang('lang.add_menu')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <form action="{{route('admin.menu.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="date" class="col-sm-2 col-form-label">@lang('lang.date'):</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="date" name="date" required autocomplete="date" min="" max="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="meals" class="col-sm-3 col-form-label">@lang('lang.time_of_meals'):</label>
                    <div class="col-sm-7">
                        <select class="form-select mb-3" aria-label="Default select example" id="meals" name="meals">
                            <option ></option>
                            <option value="breakfast">@lang('lang.breakfast')</option>
                            <option value="lunch">@lang('lang.lunch')</option>
                            <option value="snack">@lang('lang.snack')</option>
                            <option value="dinner">@lang('lang.dinner')</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">@lang('lang.food_name'):</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="name" id="name" multiple required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="calories" class="col-sm-2 col-form-label">@lang('lang.calories'):</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="number" name="calories" id="calories" multiple required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">@lang('lang.image'):</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" accept="image/*" id="image" name="image" required>
                    </div>
                </div>


                <button class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>

    @foreach($formattedDates as $date)
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4 text-center">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">{{$date['date']}}  {{$date['day']}}</h5>
                    <div>
                        <a href="{{route('admin.menu.edit', $date['date'] )}}" class="text-success"><i class="fas fa-pen me-2"></i></a>
                    </div>
                </div>

                <br>
                <div class="container text-center">
                    <div class="row align-items-center">
                        <div class="row">
                            @foreach($menus as $menu)
                                @if($date['date'] == $menu->date)
                                    <div class="col-12 col-md-3 mb-3">
                                        <div class="menu-item">
                                            <div class="menu-meals mb-0" style="height: 20px">{{$menu->meals}}</div>
                                            <br>
                                            <div class="image-container " >
                                                <img src="{{ asset($menu->image) }}" class="img-fluid" style="width: 200px; height: 200px; object-fit: cover">
                                            </div>
                                            <div class="menu-details">
                                                <dt class="col-sm">{{$menu->name}}</dt>
                                                <p class="menu-calories">@lang('lang.calories'): {{$menu->calories}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
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
