@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="addUserBtnId" onclick="showForm()">@lang('lang.add_news')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <form action="{{route('admin.news.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="group_id" class="col-sm-3 col-form-label">@lang('lang.emp_group_name'):</label>
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
                    <label for="media" class="col-sm-2 col-form-label">Медиа:</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" accept="image/*,video/*" id="media" name="media[]" multiple required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="text" class="col-sm-2 col-form-label">Текст:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="text" name="text" style="height: 150px;"></textarea>
                    </div>
                </div>


                <button class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>

    @foreach($dates as $index => $date)
        @php $group_name = 0; @endphp
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">{{$date->datetime}}</h6>
                    <form action="{{route('admin.news.delete', $date->datetime)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button id="delete_button" type="submit" class="border-0 bg-transparent" onclick="return deletedBtn()">
                            <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                        </button>
                    </form>
                </div>


                <!-- Carousel wrapper -->
                <div id="carouselExampleIndicators-{{$index}}" class="carousel slide">
                    <div class="carousel-inner" style="width: 100%; height: 500px;">
                        @php
                            $firstItem = true; // Flag to track the first item
                        @endphp
                        @foreach($news as $new)
                            @if($new->datetime == $date->datetime)
                                @if($new->group == null)
                                    @php $group_name = "All" @endphp
                                @else
                                    @php $group_name = $new->group->name @endphp
                                @endif
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
                        <figcaption class="blockquote-footer">
                            @if($group_name == "All")
                                @lang('lang.all')
                            @else
                                {{$group_name}}
                            @endif
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    @endforeach

@endsection
<script>
    function deletedBtn(){
        let text = "@lang('lang.delete_question_news')";
        return confirm(text);
    }
</script>
