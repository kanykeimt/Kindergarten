@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">@lang('lang.edit_btn')</h3>
            <div class="container">
                <form action="{{route('admin.children.update', $child->id)}}" method="POST" enctype="multipart/form-data">
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
                        <label for="parent_id" class="col-sm-5 col-form-label">@lang('lang.child_parent'):</label>
                        <div class="col-sm-8">
                            <select class="form-select mb-3" aria-label="Default select example" id="parent_id" name="parent_id">
                                <option></option>
                                @foreach($parents as $parent)
                                    <option value="{{$parent->id}}" @if($parent->id === $child->parent_id) selected @endif>{{$parent->name}}  {{$parent->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('parent_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="group_id" class="col-sm-5 col-form-label">@lang('lang.child_group'):</label>
                        <div class="col-sm-8">
                            <select class="form-select mb-3" aria-label="Default select example" id="group_id" name="group_id">
                                <option></option>
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}" @if($group->id === $child->group_id) selected @endif>{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('group_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

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
                        <a href="{{route('admin.children.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                        <button type="submit" class="btn btn-success">@lang('lang.save_btn')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
