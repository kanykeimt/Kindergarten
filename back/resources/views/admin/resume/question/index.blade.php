@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="addUserBtnId" onclick="showForm()">@lang('lang.add_question')</button>
        <div class="d-none" id="addUserId" class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.create_question_form')</h6>
            <form action="{{route('admin.resume.question.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="question_kg" class="col-sm-3 col-form-label">@lang('lang.question_kg'):</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" id="question_kg" name="question_kg" style="height: 150px;"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="question_ru" class="col-sm-3 col-form-label">@lang('lang.question_ru'):</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" id="question_ru" name="question_ru" style="height: 150px;"></textarea>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="cancelForm()">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.question_list')</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:2%">id</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:60%">@lang('lang.questions')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.action')</th>
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchById(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                        <th class=""></th>
                    </tr>
                    </thead>
                    <tbody id="questionTable">
                    @foreach ($questions as $question)
                        <tr class=>
                            <td class="">{{$question->id}}</td>
                            <td class="">{{$question->text}}</td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <a href="{{route('admin.resume.question.show', $question)}}"><i class="fa fa-info me-2"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <a href="{{route('admin.resume.question.edit', $question)}}" class="text-success"><i class="fas fa-pen me-2"></i></a>
                                </div>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <form action="{{route('admin.resume.question.delete', $question->id)}}" method="POST">
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
            let text = "@lang('lang.delete_question_question')";
            if (confirm(text) === true) {
                button.setAttribute('type', 'submit');
            } else {
                button.setAttribute('type', 'button');
            }
        }
        function searchById(value){
            let table = document.getElementById('questionTable');
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
        function searchByQuestion(value){
            let table = document.getElementById('questionTable');
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
    </script>
@endsection
