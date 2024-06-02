<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Aruu</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('user_view_template/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('user_view_template/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('user_view_template/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('user_view_template/css/vertical-layout-light/style.css')}}">
    <link href="{{asset('new_template/img/aruu%20logo1.png')}}" rel="icon">
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <img src="{{asset('new_template/img/aruu%20logo1.png')}}" style="height: 90px; width: 90px" alt="logo">
                            <img src="{{asset('new_template/img/aruu%20logo2.png')}}" style="height: 100px; width: 100px">
                        </div>
                        <form class="pt-3" method="POST" action="{{ route('user.auth') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="@lang('lang.email')">
                                @if(session('errorWithEmail'))
                                    <p class="text-danger">{{session('errorWithEmail')}}</p>
                                    <script>
                                        document.getElementById('email').value = "{{session('email')}}";
                                    </script>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="@lang('lang.password')">
                                @if(session('errorWithPassword'))
                                    <p class="text-danger">{{session('errorWithPassword')}}</p>
                                    <script>
                                        document.getElementById('email').value = "{{session('email')}}";
                                    </script>
                                @endif
                            </div>
                            <div class="mt-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mr-2">@lang('lang.close_btn')</button>
                                <button type="submit" class="btn btn-primary">@lang('lang.log_in')</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <a href="{{route('reset.password.form')}}" class="auth-link text-black">@lang('lang.forgotten_password')</a>
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                Don't have an account? <a href="{{route('user.register.form')}}" class="text-primary">Create</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('user_view_template/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('user_view_template/js/off-canvas.js')}}"></script>
<script src="{{asset('user_view_template/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('user_view_template/js/template.js')}}"></script>
<script src="{{asset('user_view_template/js/settings.js')}}"></script>
<script src="{{asset('user_view_template/js/todolist.js')}}"></script>
<!-- endinject -->
</body>

</html>
