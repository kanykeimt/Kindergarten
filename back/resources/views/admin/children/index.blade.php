@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" style="margin-right:85%;" id="addUserBtnId" onclick="showForm()">@lang('lang.add_child')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.create_child_form')</h6>
            <form action="{{route('admin.children.create')}}" method="POST" enctype="multipart/form-data">
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
                    <label for="birth_date" class="col-sm-2 col-form-label">@lang('lang.child_birth_date'):</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required autocomplete="birth_date">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="phone_number" class="col-sm-2 col-form-label">@lang('lang.child_gender'):</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="option-1" value="Male" required>
                            <label class="form-check-label" for="option-1">@lang('lang.gender_male')</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="option-2" value="Female" required>
                            <label class="form-check-label" for="option-2">@lang('lang.gender_female')</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="parent_id" class="col-sm-3 col-form-label">@lang('lang.child_parent'):</label>
                    <div class="col-sm-7">
                        <select class="form-select mb-3" aria-label="Default select example" id="parent_id" name="parent_id" required>
                            <option></option>
                            @foreach($parents as $parent)
                                <option value="{{$parent->id}}">{{$parent->name}}  {{$parent->surname}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="group_id" class="col-sm-3 col-form-label">@lang('lang.child_group'):</label>
                    <div class="col-sm-7">
                        <select class="form-select mb-3" aria-label="Default select example" id="group_id" name="group_id" required>
                            <option></option>
                            @foreach($groups as $group)
                                @if($amount_child_group[$group->id] < $group->limit)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @else
                                    <option value="{{$group->id}}" disabled>{{$group->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="photo" class="col-sm-2 col-form-label">@lang('lang.child_photo'):</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" accept="image/*" id="photo" name="photo" multiple>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="birth_certificate" class="col-sm-4 col-form-label">@lang('lang.child_birth_cert'):</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="file" accept="image/*" id="birth_certificate" name="birth_certificate" required multiple>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="med_certificate" class="col-sm-5 col-form-label">@lang('lang.child_med_cert'):</label>
                    <div class="col-sm-5">
                        <input class="form-control" type="file" accept="image/*" id="med_certificate" name="med_certificate" multiple>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="med_disability" class="col-sm-5 col-form-label">@lang('lang.child_med_dis'):</label>
                    <div class="col-sm-5">
                        <input class="form-control" type="file" accept="image/*" id="med_disability" name="med_disability" multiple>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.children_list')</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:2%">id</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:25%">@lang('lang.child_name')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.child_surname')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:10%">@lang('lang.child_group')</th>
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
                    <tbody id="childTable">
                    @foreach ($children as $child)
                        <tr class=>
                            <td class="">{{$child->id}}</td>
                            <td class="">{{$child->name}}</td>
                            <td class="">{{$child->surname}}</td>
                            <td class="">{{$child->group->name}}
                            </td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <a href="{{route('admin.children.show', $child)}}"><i class="fa fa-info me-2"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <a href="{{route('admin.children.edit', $child)}}" class="text-success"><i class="fas fa-pen me-2"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <form action="{{route('admin.children.delete', $child->id)}}" method="POST">
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
            let table = document.getElementById('childTable');
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
            let table = document.getElementById('childTable');
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
            let table = document.getElementById('childTable');
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
            let table = document.getElementById('childTable');
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


