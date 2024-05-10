@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="addUserBtnId" onclick="showForm()">@lang('lang.add_group')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.create_group_form')</h6>
            <form action="{{route('admin.group.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">@lang('lang.emp_group_name'):</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" name="name" required autocomplete="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="teacher_id" class="col-sm-2 col-form-label">@lang('lang.teacher'):</label>
                    <div class="col-sm-8">
                        <select class="form-select mb-3" aria-label="Default select example" id="teacher_id" name="teacher_id">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->surname}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="limit" class="col-sm-2 col-form-label">@lang('lang.limit'):</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control"  id="limit" name="limit" required autocomplete="limit">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">@lang('lang.description'):</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="description" name="description" style="height: 150px;"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">@lang('lang.group_image'):</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" accept="image/*" id="image" name="image" multiple required>
                    </div>
                </div>

                <button type="submit" class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.group_list')</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:2%">id</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.emp_group_name')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:5%">@lang('lang.limit')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:45%">@lang('lang.action')</th>
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchById(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByLimit(this.value)"></th>
                        <th class=""></th>
                    </tr>
                    </thead>
                    <tbody id="groupTable">
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{$group->id}}</td>
                            <td>{{$group->name}}</td>
                            <td>{{$group->limit}}</td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 25%;" class="text-center">
                                    <a href="{{route('admin.group.show', $group)}}"><i class="fa fa-info me-2"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 25%;" class="text-center">
                                    <a href="{{route('admin.group.edit', $group)}}" class="text-success"><i title="edit" class="fas fa-pen"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 25%;" class="text-center">
                                    <form action="{{route('admin.group.delete', $group->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button id="delete_button" type="button" class="border-0 bg-transparent" onclick="deletedBtn(this)">
                                            <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                                        </button>
                                    </form>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 25%;" class="text-center">
                                    <a href="{{route('admin.group.Gallery', $group)}}" class="text"><i title="add photo or video" class="fas fa-photo-video"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
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
                let table = document.getElementById('groupTable');
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
                let table = document.getElementById('groupTable');
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
            function searchByLimit(value){
                let table = document.getElementById('groupTable');
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
            function showForm(){
                document.getElementById("addGroupBtnId").className = "d-none";
                document.getElementById("addGroupId").className = "col-6";
            }
            function cancelForm(){
                document.getElementById("addGroupBtnId").className = "btn btn-primary";
                document.getElementById("addGroupId").className = "d-none";
            }
        </script>
    </div>
@endsection
