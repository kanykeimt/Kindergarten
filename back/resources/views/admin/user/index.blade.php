@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" style="margin-right:85%;" id="addUserBtnId" onclick="showForm()">@lang('lang.add_user')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.create_user_form')</h6>
            <form action="{{route('admin.user.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">@lang('lang.name'):</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" required autocomplete="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="surname" class="col-sm-2 col-form-label">@lang('lang.surname'):</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="surname" name="surname" required autocomplete="surname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-sm-2 col-form-label">@lang('lang.address'):</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" name="address" required autocomplete="address">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="phone_number" class="col-sm-2 col-form-label">@lang('lang.phone_number'):</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required autocomplete="phone_number">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">@lang('lang.email'):</label>
                    <div class="col-sm-7">
                        <input type="email" class="form-control" id="email" name="email" required autocomplete="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">@lang('lang.password'):</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control"  id="password" name="password" required autocomplete="password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="role" class="col-sm-2 col-form-label">@lang('lang.role'):</label>
                    <div class="col-sm-8">
                        <select class="form-select mb-3" aria-label="Default select example" id="role" name="role">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="profile_photo" class="col-sm-2 col-form-label">@lang('lang.profile_photo'):</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" accept="image/*" id="profile_photo" name="profile_photo" multiple>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="passport_front" class="col-sm-3 col-form-label">@lang('lang.passport_front'):</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="file" accept="image/*" id="passport_front" name="passport_front" multiple>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="passport_back" class="col-sm-3 col-form-label">@lang('lang.passport_back'):</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="file" accept="image/*" id="passport_back" name="passport_back" multiple>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.users_list')</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:2%">id</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:25%">@lang('lang.name')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.surname')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:10%">@lang('lang.role')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.action')</th>
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchById(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchBySurname(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByRole(this.value)"></th>
                        <th class=""></th>
                    </tr>
                    </thead>
                    <tbody id="userTable">
                    @foreach ($users as $user)
                        <tr class=>
                            <td class="">{{$user->id}}</td>
                            <td class="">{{$user->name}}</td>
                            <td class="">{{$user->surname}}</td>
                            <td class="">
                                @if($user->role == 1)
                                    Админ
                                @elseif($user->role == 2)
                                    @lang('lang.employee')
                                @elseif($user->role == 3)
                                    @lang('lang.parent')
                                @else
                                    @lang('lang.user')
                                @endif
                            </td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <a href="{{route('admin.user.show', $user)}}"><i class="fa fa-info me-2"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <a href="{{route('admin.user.edit', $user)}}" class="text-success"><i class="fas fa-pen me-2"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <form action="{{route('admin.user.delete', $user->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button id="delete_button" type="button" class="border-0 bg-transparent" onclick="deletedBtn(this)">
                                            <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function deletedBtn(button){
            let text = "@lang('lang.delete_question_group')";
            if (confirm(text) === true) {
                button.setAttribute('type', 'submit');
            } else {
                button.setAttribute('type', 'button');
            }
        }
        function searchById(value){
            let table = document.getElementById('userTable');
            let rows = table.rows;
            let n = rows.length;
            for(let i = 0; i < n; i++){
                if(rows[i].cells[0].innerHTML.indexOf(value) === -1){
                    rows[i].className = 'd-none';
                }
                else{
                    rows[i].className = '';
                }
            }
        }
        function searchByName(value){
            let table = document.getElementById('userTable');
            let rows = table.rows;
            let n = rows.length;
            for(let i = 0; i < n; i++){
                if(rows[i].cells[1].innerHTML.indexOf(value) === -1){
                    rows[i].className = 'd-none';
                }
                else{
                    rows[i].className = '';
                }
            }
        }
        function searchBySurname(value){
            let table = document.getElementById('userTable');
            let rows = table.rows;
            let n = rows.length;
            for(let i = 0; i < n; i++){
                if(rows[i].cells[2].innerHTML.indexOf(value) === -1){
                    rows[i].className = 'd-none';
                }
                else{
                    rows[i].className = '';
                }
            }
        }
        function searchByRole(value){
            let table = document.getElementById('userTable');
            let rows = table.rows;
            let n = rows.length;
            for(let i = 0; i < n; i++){
                if(rows[i].cells[3].innerHTML.indexOf(value) === -1){
                    rows[i].className = 'd-none';
                }
                else{
                    rows[i].className = '';
                }
            }
        }
    </script>
@endsection
