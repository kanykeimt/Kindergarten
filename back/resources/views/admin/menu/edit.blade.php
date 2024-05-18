@extends('layouts.admin_layout')
@section('content')
    <div class="col-sm-12">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">@lang('lang.edit_btn')</h4>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach($menus as $index => $menu)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{$index == 0? 'active' : ''}}" id="pills-{{$index}}-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-{{$index}}" type="button" role="tab" aria-controls="pills-{{$index}}"
                                aria-selected="true">{{$menu->meals}}</button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach($menus as $index => $menu)
                    <div class="tab-pane fade show {{$index == 0? 'active' : ''}}" id="pills-{{$index}}" role="tabpanel" aria-labelledby="pills-{{$index}}-tab">
                        <div class="container">
                            <form action="{{route('admin.menu.update', $menu->id)}}" method="POST" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">@lang('lang.food_name'):</label>
                                    <input type="text" class="form-control col-6" name="name" id="name" value="{{$menu->name}}" required autofocus>
                                    @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="calories" class="form-label">@lang('lang.calories'):</label>
                                    <input type="number" class="form-control col-6" name="calories" id="calories" value="{{$menu->calories}}" required autofocus >
                                    @error('limit')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="date" class="form-label">@lang('lang.date'):</label>
                                    <input type="date" class="form-control col-6" name="date" id="date" value="{{$menu->date}}" required autofocus>
                                    @error('limit')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputFile" class="form-label">@lang('lang.group_image'):</label>
                                    <div class="col-sm-6">
                                        <img class="img-fluid mb-3" src="{{asset($menu->image)}}"  alt="image" style="width:100%;">
                                    </div>

                                    <input type="file" class="form-control col-6" accept="image/*" name="image" id="image">
                                    @error('passport_front')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <br>
                                <div class="modal-footer">
                                    <a href="{{route('admin.menu.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                                    <button type="submit" class="btn btn-success">@lang('lang.save_btn')</button>
                                </div>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
