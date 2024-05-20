@extends('layouts.employee_layout')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">@lang('lang.parents_list')</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:25%">@lang('lang.name')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.surname')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:30%">@lang('lang.phone_number')</th>
                        <th scope="col" style="vertical-align:middle;overflow:hidden;cursor:pointer;width:10%">@lang('lang.action')</th>
                    </tr>
                    <tr class="table-sm">
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchByName(this.value)"></th>
                        <th class=""><input class="form-control form-control-sm" value="" oninput="searchBySurname(this.value)"></th>
                        <th class=""></th>
                        <th class=""></th>
                    </tr>
                    </thead>
                    <tbody id="userTable">
                    @foreach ($parents as $parent)
                        <tr class=>
                            <td class="">{{$parent->name}}</td>
                            <td class="">{{$parent->surname}}</td>
                            <td class="">{{$parent->phone_number}}</td>
                            <td>
                                <div style="float: left;
                                display: block;
                                width: 33%;" class="text-center">
                                    <a href="{{route('employee.user.show', $parent)}}"><i class="fa fa-info me-2"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
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
    </script>
@endsection
