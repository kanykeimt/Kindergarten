@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('style')
    <style>
        body {
            margin-top: 20px;
        }

        .bg-light-gray {
            background-color: #f7f7f7;
        }

        .table-bordered thead td, .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .bg-sky.box-shadow {
            box-shadow: 0px 5px 0px 0px #00a2a7;
        }

        .bg-orange.box-shadow {
            box-shadow: 0px 5px 0px 0px #af4305;
        }

        .bg-green.box-shadow {
            box-shadow: 0px 5px 0px 0px #4ca520;
        }

        .bg-yellow.box-shadow {
            box-shadow: 0px 5px 0px 0px #dcbf02;
        }

        .bg-pink.box-shadow {
            box-shadow: 0px 5px 0px 0px #e82d8b;
        }

        .bg-purple.box-shadow {
            box-shadow: 0px 5px 0px 0px #8343e8;
        }

        .bg-lightred.box-shadow {
            box-shadow: 0px 5px 0px 0px #d84213;
        }

        .bg-sky {
            background-color: #02c2c7;
        }

        .bg-orange {
            background-color: #e95601;
        }

        .bg-green {
            background-color: #5bbd2a;
        }

        .bg-yellow {
            background-color: #f0d001;
        }

        .bg-pink {
            background-color: #ff48a4;
        }

        .bg-purple {
            background-color: #9d60ff;
        }

        .bg-lightred {
            background-color: #ff5722;
        }

        .padding-15px-lr {
            padding-left: 15px;
            padding-right: 15px;
        }

        .padding-5px-tb {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .margin-10px-bottom {
            margin-bottom: 10px;
        }

        .border-radius-5 {
            border-radius: 5px;
        }

        .margin-10px-top {
            margin-top: 10px;
        }

        .font-size14 {
            font-size: 14px;
        }

        .text-light-gray {
            color: #d6d5d5;
        }

        .font-size13 {
            font-size: 13px;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            .table thead {
                display: none;
            }

            .table tr {
                display: block;
                margin-bottom: 10px;
            }

            .table td {
                display: block;
                text-align: right;
                font-size: 13px;
                border-bottom: 1px solid #dee2e6;
                padding: 8px;
                position: relative;
            }

            .table td::before {
                content: attr(data-label);
                float: left;
                text-transform: uppercase;
                font-weight: bold;
            }

            .table td:last-child {
                border-bottom: 0;
            }
        }

    </style>
@endsection
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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-classes-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-classes" type="button" role="tab"
                                aria-controls="pills-classes" aria-selected="false">@lang('lang.classes')</button>
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
                    <div class="tab-pane fade" id="pills-classes" role="tabpanel" aria-labelledby="pills-classes-tab">
                        <div class="container">
                            <div class="timetable-img text-center">
                                <img src="img/content/timetable.png" alt="">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-uppercase">Time</th>
                                        <th class="text-uppercase">Monday</th>
                                        <th class="text-uppercase">Tuesday</th>
                                        <th class="text-uppercase">Wednesday</th>
                                        <th class="text-uppercase">Thursday</th>
                                        <th class="text-uppercase">Friday</th>
                                        <th class="text-uppercase">Saturday</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="align-middle" data-label="Time">09:00am</td>
                                        <td data-label="Monday">
                                            <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Dance</span>
                                            <div class="margin-10px-top font-size14">9:00-10:00</div>
                                            <div class="font-size13 text-light-gray">Ivana Wong</div>
                                        </td>
                                        <td data-label="Tuesday">
                                            <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Yoga</span>
                                            <div class="margin-10px-top font-size14">9:00-10:00</div>
                                            <div class="font-size13 text-light-gray">Marta Healy</div>
                                        </td>
                                        <td data-label="Wednesday">
                                            <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Music</span>
                                            <div class="margin-10px-top font-size14">9:00-10:00</div>
                                            <div class="font-size13 text-light-gray">Ivana Wong</div>
                                        </td>
                                        <td data-label="Thursday">
                                            <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Dance</span>
                                            <div class="margin-10px-top font-size14">9:00-10:00</div>
                                            <div class="font-size13 text-light-gray">Ivana Wong</div>
                                        </td>
                                        <td data-label="Friday">
                                            <span class="bg-purple padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Art</span>
                                            <div class="margin-10px-top font-size14">9:00-10:00</div>
                                            <div class="font-size13 text-light-gray">Kate Alley</div>
                                        </td>
                                        <td data-label="Saturday">
                                            <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">English</span>
                                            <div class="margin-10px-top font-size14">9:00-10:00</div>
                                            <div class="font-size13 text-light-gray">James Smith</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle" data-label="Time">10:00am</td>
                                        <td data-label="Monday">
                                            <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Music</span>
                                            <div class="margin-10px-top font-size14">10:00-11:00</div>
                                            <div class="font-size13 text-light-gray">Ivana Wong</div>
                                        </td>
                                        <td class="bg-light-gray" data-label="Tuesday"></td>
                                        <td data-label="Wednesday">
                                            <span class="bg-purple padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Art</span>
                                            <div class="margin-10px-top font-size14">10:00-11:00</div>
                                            <div class="font-size13 text-light-gray">Kate Alley</div>
                                        </td>
                                        <td data-label="Thursday">
                                            <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Yoga</span>
                                            <div class="margin-10px-top font-size14">10:00-11:00</div>
                                            <div class="font-size13 text-light-gray">Marta Healy</div>
                                        </td>
                                        <td data-label="Friday">
                                            <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">English</span>
                                            <div class="margin-10px-top font-size14">10:00-11:00</div>
                                            <div class="font-size13 text-light-gray">James Smith</div>
                                        </td>
                                        <td class="bg-light-gray" data-label="Saturday"></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle" data-label="Time">11:00am</td>
                                        <td data-label="Monday">
                                            <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Break</span>
                                            <div class="margin-10px-top font-size14">11:00-12:00</div>
                                        </td>
                                        <td data-label="Tuesday">
                                            <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Break</span>
                                            <div class="margin-10px-top font-size14">11:00-12:00</div>
                                        </td>
                                        <td data-label="Wednesday">
                                            <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Break</span>
                                            <div class="margin-10px-top font-size14">11:00-12:00</div>
                                        </td>
                                        <td data-label="Thursday">
                                            <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Break</span>
                                            <div class="margin-10px-top font-size14">11:00-12:00</div>
                                        </td>
                                        <td data-label="Friday">
                                            <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Break</span>
                                            <div class="margin-10px-top font-size14">11:00-12:00</div>
                                        </td>
                                        <td data-label="Saturday">
                                            <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Break</span>
                                            <div class="margin-10px-top font-size14">11:00-12:00</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle" data-label="Time">12:00pm</td>
                                        <td class="bg-light-gray" data-label="Monday"></td>
                                        <td data-label="Tuesday">
                                            <span class="bg-purple padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Art</span>
                                            <div class="margin-10px-top font-size14">12:00-1:00</div>
                                            <div class="font-size13 text-light-gray">Kate Alley</div>
                                        </td>
                                        <td data-label="Wednesday">
                                            <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Dance</span>
                                            <div class="margin-10px-top font-size14">12:00-1:00</div>
                                            <div class="font-size13 text-light-gray">Ivana Wong</div>
                                        </td>
                                        <td data-label="Thursday">
                                            <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Music</span>
                                            <div class="margin-10px-top font-size14">12:00-1:00</div>
                                            <div class="font-size13 text-light-gray">Ivana Wong</div>
                                        </td>
                                        <td class="bg-light-gray" data-label="Friday"></td>
                                        <td data-label="Saturday">
                                            <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Yoga</span>
                                            <div class="margin-10px-top font-size14">12:00-1:00</div>
                                            <div class="font-size13 text-light-gray">Marta Healy</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle" data-label="Time">01:00pm</td>
                                        <td data-label="Monday">
                                            <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">English</span>
                                            <div class="margin-10px-top font-size14">1:00-2:00</div>
                                            <div class="font-size13 text-light-gray">James Smith</div>
                                        </td>
                                        <td data-label="Tuesday">
                                            <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Music</span>
                                            <div class="margin-10px-top font-size14">1:00-2:00</div>
                                            <div class="font-size13 text-light-gray">Ivana Wong</div>
                                        </td>
                                        <td class="bg-light-gray" data-label="Wednesday"></td>
                                        <td data-label="Thursday">
                                            <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">English</span>
                                            <div class="margin-10px-top font-size14">1:00-2:00</div>
                                            <div class="font-size13 text-light-gray">James Smith</div>
                                        </td>
                                        <td data-label="Friday">
                                            <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Yoga</span>
                                            <div class="margin-10px-top font-size14">1:00-2:00</div>
                                            <div class="font-size13 text-light-gray">Marta Healy</div>
                                        </td>
                                        <td data-label="Saturday">
                                            <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Music</span>
                                            <div class="margin-10px-top font-size14">1:00-2:00</div>
                                            <div class="font-size13 text-light-gray">Ivana Wong</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
