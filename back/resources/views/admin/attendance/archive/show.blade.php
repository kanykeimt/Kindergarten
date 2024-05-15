@extends('layouts.admin_layout')
@section('content')


    @foreach($attendances as $index => $group)
        <div class="col-sm-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{$index}}">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$index}}"
                                aria-expanded="false" aria-controls="flush-collapse{{$index}}">
                            {{$group->name}}
                        </button>
                    </h2>
                    <div id="flush-collapse{{$index}}" class="accordion-collapse collapse"
                         aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="table-sm">
                                        <th class="">id</th>
                                        <th class="">@lang('lang.full_name_child')</th>
                                        @for($i = 1; $i <= \Carbon\Carbon::now()->startOfMonth()->diffInDays(\Carbon\Carbon::now()) + 1; $i++)
                                            <th class="" >{{$i}}</th>
                                        @endfor

                                    </tr>
                                    </thead>
                                    <tbody id="paymentTable">
                                    @foreach ($group->child as $child)
                                        <tr>
                                            <td>{{$child->id}}</td>
                                            <td >{{$child->name}} {{$child->surname}}</td>
                                            @for($i = 1; $i <= \Carbon\Carbon::now()->startOfMonth()->diffInDays(\Carbon\Carbon::now()) + 1; $i++)
                                                @php $attendanceFound = false; @endphp
                                                @foreach($group->attendance as $attendance)
                                                    @if((date('j', strtotime($attendance->date)) == $i))
                                                        @php $attendanceFound = true; $attendances = (json_decode($attendance->attendance, true)) @endphp
                                                        @if(array_key_exists($child->id, $attendances))
                                                            @if($attendances[$child->id])
                                                                <th> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked disabled></th>
                                                            @elseif($attendances[$child->id] == false)
                                                                <th> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled></th>
                                                            @endif

                                                        @else
                                                            <th></th>
                                                        @endif
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if (!$attendanceFound)
                                                    <th></th>
                                                @endif
                                            @endfor
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
