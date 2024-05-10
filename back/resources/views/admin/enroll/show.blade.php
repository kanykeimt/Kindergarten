@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="container">
                <form action="{{route('admin.enroll.approve', $enroll->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">@lang('lang.child_name'):</label>
                        <input type="text" class="form-control col-6" name="name" id="name" value="{{$enroll->name}}" required>
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="surname" class="form-label">@lang('lang.child_surname'):</label>
                        <input type="text" class="form-control col-6" name="surname" id="surname" value="{{$enroll->surname}}" required >
                        @error('surname')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="birth_date" class="form-label">@lang('lang.child_birth_date'):</label>
                        <input type="date" class="form-control" id="birth_date" value="{{$enroll->birth_date}}" name="birth_date" autocomplete="birth_date" >
                        @error('birth_date')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="gender" class="form-label">@lang('lang.child_gender'):</label>
                        <input type="text" class="form-control col-6" value="{{ $enroll->gender == 'Male' ? __('lang.gender_male') : __('lang.gender_female')  }}" required disabled>
                        <input type="text" class="form-control col-6" name="gender" id="gender" value="{{$enroll->gender}}" required hidden="">

                        @error('gender')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="parent_id" class="col-sm-5 col-form-label">@lang('lang.child_parent'):</label>
                        <input type="text" class="form-control" value="{{$parent[0]->name}} {{$parent[0]->surname}}" disabled >
                        <input type="number" class="form-control" id="parent_id" value="{{$enroll->parent_id}}" name="parent_id" autocomplete="parent_id" hidden="">
                        @error('parent_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.child_photo'):</label>
                        <div class="">
                            <img class="img-fluid" src="{{asset($enroll->photo)}}" alt="Child's photo" style="width:70%;">
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
                            <img class="img-fluid img" src="{{asset($enroll->birth_certificate)}}" alt="Child's birth certificate" style="width:70%;">
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
                            <img class="img-fluid img" src="{{asset($enroll->med_certificate)}}" alt="child's medical certificate" style="width:70%;">
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
                            <img class="img-fluid img" src="{{asset($enroll->med_disability)}}" alt="child's medical disability certificate" style="width:70%;">
                        </div>
                        <br>
                        <input type="file" class="form-control col-6" accept="image/png, image/gif, image/jpeg" name="med_disability" id="med_disability">
                        @error('med_disability')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="group_id" class="col-sm-5 col-form-label">@lang('lang.child_group'):</label>
                        <select class="form-select mb-3" aria-label="Default select example" id="group_id" name="group_id">
                            <option></option>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                        @error('group_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="modal-footer">
                        <a href="{{route('admin.enroll.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                        <button type="submit" class="btn btn-success">@lang('lang.approve_btn')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

