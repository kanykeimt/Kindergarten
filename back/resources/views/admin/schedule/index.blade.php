@extends('layouts.admin_layout')
@section('content')



    @foreach($groups as $index => $group)
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
                                jgsjgl
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
@section('script')
@endsection
