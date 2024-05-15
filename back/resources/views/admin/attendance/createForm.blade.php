@extends('layouts.admin_layout')
@section('content')
    <div class="col-12">
        <div  id="addUserId" class="bg-light rounded h-100 p-4">
            <form action="{{route('admin.attendance.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="group_id" class="col-sm-3 col-form-label">@lang('lang.child_group'):</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{$group->id}}" id="group_id" name="group_id" hidden="" >
                        <input type="text" class="form-control" value="{{$group->name}}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="date" class="col-sm-2 col-form-label">@lang('lang.date'):</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{$request->date}}" required autocomplete="date" disabled>
                        <input type="date" class="form-control"  id="date" name="date" value="{{$request->date}}" required autocomplete="date" hidden="">
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr class="table-sm">
                        <th class="">id</th>
                        <th class="">@lang('lang.child_name')</th>
                        <th class="">@lang('lang.child_surname')</th>
                        <th class="">
                            <div class="form-check">
                                All
                                <input class="form-check-input" type="checkbox" onclick="selectAll(this)">
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="childTable">
                    @foreach ($children as $index => $child)
                        <tr class=>
                            <td class="">{{$index + 1}}</td>
                            <td class="">{{$child->name}}</td>
                            <td class="">{{$child->surname}}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{'child-'.$child->id}}" name="{{'child-'.$child->id}}" >
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <a href="{{route('admin.attendance.index')}}" class="btn btn-secondary">@lang('lang.back_btn')</a>
                <button type="submit" class="btn btn-success">@lang('lang.saveBtn')</button>
            </form>
        </div>
    </div>

    <script>
        function selectAll(checkbox) {
            let checkboxes = document.querySelectorAll('.form-check-input[type="checkbox"]');
            checkboxes.forEach(function(element) {
                element.checked = checkbox.checked;
            });
        }
    </script>
@endsection
