@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">@lang('lang.edit_btn')</h3>
            <div class="container">
                <form action="{{route('admin.user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.name'):</label>
                        <input type="text" class="form-control col-6" name="name" id="name" value="{{$user->name}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.surname'):</label>
                        <input type="text" class="form-control col-6" name="surname" id="surname" value="{{$user->surname}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                        @error('surname')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.address'):</label>
                        <input type="text" class="form-control col-6" name="address" id="address" value="{{$user->address}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                        @error('address')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.phone_number'):</label>
                        <input type="text" class="form-control col-6" name="phone_number" id="phone_number" value="{{$user->phone_number}}" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">
                        @error('phone_number')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="role" class="col-sm-2 col-form-label">@lang('lang.role'):</label>
                        <div class="col-sm-8">
                            <select class="form-select mb-3" aria-label="Default select example" id="role" name="role">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" @if($role->id === $user->role) selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.passport_front'):</label>
                        <div class="">
                            <img class="img-fluid img" src="{{asset($user->passport_front)}}" alt="Child's birth certificate" style="width:70%;">
                        </div>
                        <br>
                        <input type="file" class="form-control col-6" accept="image/png, image/gif, image/jpeg" name="passport_front" id="passport_front">
                        @error('passport_front')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput" class="form-label">@lang('lang.passport_back'):</label>
                        <div class="">
                            <img class="img-fluid img" src="{{asset($user->passport_back)}}" alt="Child's birth certificate" style="width:70%;">
                        </div>
                        <br>
                        <input type="file" class="form-control col-6" accept="image/png, image/gif, image/jpeg" name="passport_back" id="passport_back">
                        @error('passport_back')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="modal-footer">
                        <a href="{{route('admin.user.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                        <button type="submit" class="btn btn-success">@lang('lang.save_btn')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
