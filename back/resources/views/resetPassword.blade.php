@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('reset.password.link') }}" >
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">@lang('lang.email')</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="" name="email" required autocomplete="email">

                                    @if(session('errorWithEmail'))
                                        <p class="text-danger">{{session('errorWithEmail')}}</p>
                                        <script>
                                            document.getElementById('email').value = "{{session('email')}}";
                                        </script>
                                    @endif
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
