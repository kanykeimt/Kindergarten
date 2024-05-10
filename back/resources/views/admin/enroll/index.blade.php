@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.queue_list')</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:2%">id</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:25%">@lang('lang.child_name')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:25%">@lang('lang.child_surname')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:20%">@lang('lang.child_parent')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.action')</th>
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchById(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchBySurname(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByParent(this.value)"></th>
                        <th class=""></th>
                    </tr>
                    </thead>
                    <tbody id="enrollTable">
                    @foreach ($enrolls as $enroll)
                        <tr class="odd">
                            <td class="sorting_1">{{$enroll->id}}</td>
                            <td>{{$enroll->name}}</td>
                            <td>{{$enroll->surname}}</td>
                            <td>{{$enroll->parent->name}}</td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 50%;" class="text-center">
                                    <a href="{{route('admin.enroll.show', $enroll)}}" class="text-success"><i class="fas fa-check-circle"></i></a>
                                </div>
                                <div style="float: right;
                                display: block;
                                width: 50%;" class="text-center">
                                    <form action="{{route('admin.enroll.delete', $enroll)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button id="delete_button" type="button" class="border-0 bg-transparent" onclick="deletedBtn(this)">
                                            <i title="delete" class="fas fa-trash text-danger" role="button"></i>
                                        </button>
                                    </form>
                                </div>


                            </td>
                            {{-- td>rfed</td> --}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function deletedBtn(button){
            let text = "@lang('lang.delete_question_queue')";
            if (confirm(text) === true) {
                button.setAttribute('type', 'submit');
            } else {
                button.setAttribute('type', 'button');
            }
        }
        function searchById(value){
            let table = document.getElementById('enrollTable');
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
            let table = document.getElementById('enrollTable');
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
            let table = document.getElementById('enrollTable');
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
        function searchByParent(value){
            let table = document.getElementById('enrollTable');
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
