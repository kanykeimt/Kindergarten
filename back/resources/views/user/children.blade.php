@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('content')

    <div class="container d-flex justify-content-center">
        <div class="col-sm-10">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">@lang('lang.emp_group_name'): {{$child->group->name}}</h6>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">@lang('lang.news')</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab"
                                aria-controls="pills-profile" aria-selected="false">@lang('lang.child_info_btn')</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab"
                                aria-controls="pills-contact" aria-selected="false">@lang('lang.payment_btn')</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        @foreach($dates as $index => $date)
                            <div class="col-12">
                                <div class="rounded h-100 p-4" style="background-color: #f8f9fa;">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h6 class="mb-0">{{$date->datetime}}</h6>
                                    </div>


                                    <!-- Carousel wrapper -->
                                    <div id="carouselExampleIndicators-{{$index}}" class="carousel slide">
                                        <div class="carousel-inner" style="width: 100%; height: 500px;">
                                            @php
                                                $firstItem = true; // Flag to track the first item
                                            @endphp
                                            @foreach($news as $new)
                                                @if($new->datetime == $date->datetime)
                                                    @if($new->media->type == 'image')
                                                        <div class="carousel-item {{ $firstItem ? 'active' : '' }}" style="width: 100%; height: 100%;">
                                                            <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100%;">
                                                                <img src="{{ asset($new->media->media) }}" class="img-fluid" alt="..." style="max-height: 100%; max-width: 100%;">
                                                            </div>
                                                        </div>

                                                    @elseif($new->media->type = 'video')
                                                        <div class="carousel-item {{ $firstItem ? 'active' : '' }}" style="width: 100%; height: 100%;">
                                                            <video class="img-fluid" controls autoplay loop muted style="width: 100%; height: 100%;">
                                                                <source src="{{asset($new->media->media)}}" type="video/mp4" />
                                                            </video>
                                                        </div>
                                                    @endif
                                                    @php
                                                        $firstItem = false; // Set the flag to false after the first item
                                                    @endphp
                                                @endif
                                            @endforeach

                                        </div>

                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators-{{$index}}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators-{{$index}}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>



                                    <!-- Carousel wrapper -->
                                    <br>
                                    <div class="border rounded p-4 pb-0 mb-4">
                                        <figure class="text-center">
                                            <blockquote class="blockquote">
                                                <p>{{$date->text}}</p>
                                            </blockquote>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="container d-flex justify-content-center">
                            <div class="col-12">
                                <div class="rounded h-100 p-4" style="background-color: #f8f9fa;">
                                    <h3 class="mb-4">@lang('lang.edit_btn')</h3>
                                    <div class="container">
                                        <form action="{{route('children.update', $child->id)}}" method="POST" enctype="multipart/form-data">
                                            @method('patch')
                                            @csrf
                                            <div class="form-group">
                                                <label for="name" class="form-label">@lang('lang.child_name'):</label>
                                                <input type="text" class="form-control col-6" name="name" id="name" value="{{$child->name}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                                                @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="surname" class="form-label">@lang('lang.child_surname'):</label>
                                                <input type="text" class="form-control col-6" name="surname" id="surname" value="{{$child->surname}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                                                @error('surname')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="birth_date" class="form-label">@lang('lang.child_birth_date'):</label>
                                                <input type="date" class="form-control" id="birth_date" value="{{$child->birth_date}}" name="birth_date" autocomplete="birth_date">
                                                @error('birth_date')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="gender" class="form-label">@lang('lang.child_gender'):</label>
                                                <div class="col-sm-8">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" id="option-1" value="Male" required {{ $child->gender == "Male" ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option-1">@lang('lang.gender_male')</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" id="option-2" value="Female" required {{ $child->gender == "Female" ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option-2">@lang('lang.gender_female')</label>
                                                    </div>
                                                </div>
                                                @error('gender')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="exampleInput" class="form-label">@lang('lang.child_photo'):</label>
                                                <div class="">
                                                    <img class="img-fluid" src="{{asset($child->photo)}}" alt="Child's photo" style="width:70%;">
                                                </div>
                                                <br>
                                                <input type="file" class="form-control col-6" accept="image/png, image/gif, image/jpeg" name="photo" id="photo">
                                                @error('photo')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleInput" class="form-label">@lang('lang.child_birth_cert'):</label>
                                                <div class="">
                                                    <img class="img-fluid img" src="{{asset($child->birth_certificate)}}" alt="Child's birth certificate" style="width:70%;">
                                                </div>
                                                <br>
                                                <input type="file" class="form-control col-6" accept="image/png, image/gif, image/jpeg" name="birth_certificate" id="birth_certificate">
                                                @error('birth_certificate')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleInput" class="form-label">@lang('lang.child_med_cert'):</label>
                                                <div class="">
                                                    <img class="img-fluid img" src="{{asset($child->med_certificate)}}" alt="child's medical certificate" style="width:70%;">
                                                </div>
                                                <br>
                                                <input type="file" class="form-control col-6" accept="image/png, image/gif, image/jpeg" name="med_certificate" id="med_certificate">
                                                @error('med_certificate')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleInput" class="form-label">@lang('lang.child_med_dis'):</label>
                                                <div class="">
                                                    <img class="img-fluid img" src="{{asset($child->med_disability)}}" alt="child's medical disability certificate" style="width:70%;">
                                                </div>
                                                <br>
                                                <input type="file" class="form-control col-6" accept="image/png, image/gif, image/jpeg" name="med_disability" id="med_disability">
                                                @error('med_disability')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <br>


                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">@lang('lang.save_btn')</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="container d-flex justify-content-center">
                            <div class="col-12">
                                <div class="rounded h-100 p-4" style="background-color: #f8f9fa;">
                                    <div id="addUserId">
                                        <form action="{{route('children.payment')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="child_id" class="col-sm-3 col-form-label">@lang('lang.full_name_child'):</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control col-6" value="{{$child->name}} {{$child->surname}}" required disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3" hidden="">
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control col-6" name="child_id" id="child_id" value="{{$child->id}}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="date_from" class="col-sm-2 col-form-label">@lang('lang.from'):</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" id="date_from" name="date_from" value="" required autocomplete="date_from">
                                                </div>
                                            </div>
                                            <div class="row mb-3" hidden="">
                                                <label for="date_to" class="col-sm-2 col-form-label">@lang('lang.to'):</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" value="" id="date_to" name="date_to" required autocomplete="date_to">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="payment_amount" class="col-sm-2 col-form-label">@lang('lang.payment_amount'):</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="payment_amount" name="payment_amount" required autocomplete="payment_amount">
                                                </div>
                                            </div>
                                            <a href="{{route('index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                                            <button type="button" onclick="approveBtn(this)" class="btn btn-success">@lang('lang.saveBtn')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function approveBtn(button){
            let date_from = document.getElementById('date_from').value;
            let payment_amount = document.getElementById('payment_amount').value;
            let days = Math.round(payment_amount/270);
            date_from = new Date(date_from);
            let daysExcludingSundays = 0;
            while (daysExcludingSundays < days) {
                if (date_from.getDay() !== 0) {
                    daysExcludingSundays++;
                }
                date_from.setDate(date_from.getDate() + 1);
            }
            let date_to = date_from.toISOString().slice(0, 10);

            if (confirm("@lang('lang.question_for_payment_date1')"+date_to+"@lang('lang.question_for_payment_date2')") === true) {
                button.setAttribute('type', 'submit');
                document.getElementById('date_to').value = date_to;
            } else {
                button.setAttribute('type', 'button')
            }
        }
    </script>
@endsection
