
@extends('layouts.app')
@section('content')

    @foreach($formattedDates as $date)
        <div class="container d-flex justify-content-center p-4">
            <div class="col-11">
                <div class="bg-light rounded h-100 p-4 text-center">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">{{$date['date']}}  {{$date['day']}}</h5>
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
        </div>
        <br>
    @endforeach

@endsection

