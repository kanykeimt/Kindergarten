@extends('layouts.app')
@section('style')
    <style>
        .media-container {
            display: flex;
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            height: 100%; /* Set a fixed height */
        }
    </style>
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link href="{{asset('style/main_gallery_style.css')}}" rel="stylesheet">
    <div class="photo-gallery">
        <div class="container">
{{--            <div class="intro">--}}
{{--                <h2 class="text-center">Lightbox Media</h2>--}}
{{--                <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p>--}}
{{--            </div>--}}
            <div class="row photos">
                @foreach($galleries as $gallery)
                    <div class="col-sm-6 col-md-4 col-lg-3 item py-4" style="max-height: 250px; overflow: hidden">
                        <div class="media-container m-3">
                            @if($gallery->type == 'image')
                                <a href="{{ asset($gallery->media) }}" data-lightbox="photos">
                                    <img class="img-fluid mx-auto d-block" src="{{ asset($gallery->media) }}">
                                </a>
                            @elseif($gallery->type == 'video')
                                <video class="img-fluid mx-auto d-block" controls autoplay loop muted style="width: 100%; height: 100%;">
                                    <source src="{{ asset($gallery->media) }}" type="video/mp4" />
                                </video>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
@endsection
