<?php
$l = request()->segment(1, '');
$lang = url()->current();
$k = request()->getRequestUri();
$langru = "";
$langkg = "";
if($l == "ru"){
    $langru = $lang;
    $langkg = str_replace("/ru", "", $lang);
}
else if($l == ""){
    $langru = $lang.'/ru';
    $langkg = $lang;
}
else{
    $langru = url('/').'/ru'.$k;
    $langkg = $lang;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Aruu</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('new_template/img/aruu%20logo1.png')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('admin_template/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('admin_template/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('admin_template/css/style.css')}}" rel="stylesheet">
    <style>


        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: relative;
            background-color: #f9f9f9;
            width: 140px;
        }

        .dropbtnru
        {
            background: url('http://icons.iconarchive.com/icons/custom-icon-design/flag-3/16/Russia-Flag-icon.png') no-repeat left center;
            padding-left: 25px;
            width: auto;
        }
        .dropbtnkg
        {
            background: url('https://icons.iconarchive.com/icons/famfamfam/flag/16/kg-icon.png') no-repeat left center;
            padding-left: 25px;
            width: auto;
        }

        .dropbtnkg::after {
            /*background: rgba(0, 0, 0, 0) url("https://cdn3.iconfinder.com/data/icons/google-material-design-icons/48/ic_keyboard_arrow_down_48px-16.png") no-repeat scroll center center;*/
            content: "";
            height: 16px;
            position: absolute;
            right: 0;
            top: 7px;
            width: 16px;
        }




        .dropdown-content a:first-child
        {
            background: url('http://icons.iconarchive.com/icons/custom-icon-design/flag-3/16/Russia-Flag-icon.png') no-repeat left center;
        }

        .dropdown-content a:last-child
        {
            background: url('https://icons.iconarchive.com/icons/famfamfam/flag/16/kg-icon.png') no-repeat left center;
        }

        /* Links inside the dropdown */

        /* Change color of dropdown links on hover */

        /*# sourceMappingURL=style.css.map */
    </style>
    @yield('style')
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3" >
        <nav class="navbar bg-light navbar-light">
            <a href="{{route('admin')}}" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><img class="rounded-circle" src="{{asset('new_template/img/aruu%20logo1.png')}}" alt="" style="width: 60px; height: 60px;">  ARUU</h3>
            </a>
            <div class="navbar-nav w-100">
                <a href="{{route('admin.user.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.user') ? 'active' : '' }}"><i class="fa fa-users me-2"></i>@lang('lang.users')</a>
                <a href="{{route('admin.group.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.group') ? 'active' : '' }}"><i class="fa fa-list me-2"></i>@lang('lang.groups')</a>
                <a href="{{route('admin.children.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.children') ? 'active' : '' }}"><i class="fa fa-child me-2"></i>@lang('lang.children')</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link {{ (Str::startsWith(Route::currentRouteName(), 'admin.resume') or Str::startsWith(Route::currentRouteName(), 'admin.question')) ? 'active' : '' }} dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-file me-2"></i>@lang('lang.resume')</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{route('admin.resume.question.index')}}" class="dropdown-item">@lang('lang.resume_ques')</a>
                        <a href="{{route('admin.resume.index')}}" class="dropdown-item">@lang('lang.comp_resumes')</a>
                    </div>
                </div>
                <a href="{{route('admin.enroll.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.enroll') ? 'active' : '' }}"><i class="fa fa-check-circle me-2"></i>@lang('lang.queue')</a>
                <a href="{{route('admin.payment.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.payment') ? 'active' : '' }}"><i class="fa fa-credit-card me-2"></i>@lang('lang.emp_payment')</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.attendance') ? 'active' : '' }} dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-calendar-check me-2"></i>@lang('lang.emp_attendance')</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{route('admin.attendance.index')}}" class="dropdown-item">@lang('lang.current_attendance')</a>
                        <a href="{{route('admin.attendance.archive')}}" class="dropdown-item">@lang('lang.archive_attendance')</a>
                    </div>
                </div>
                <a href="{{route('admin.news.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.news') ? 'active' : '' }}"><i class="fa fa-newspaper me-2"></i>@lang('lang.news')</a>
                <a href="{{route('admin.menu.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.menu') ? 'active' : '' }}"><i class="fa fa-utensils me-2"></i>Меню</a>
                <a href="{{route('admin.schedule.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.schedule') ? 'active' : '' }}"><i class="fa fa-book me-2"></i>@lang('lang.classes')</a>
                <a href="{{route('admin.gallery.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.gallery') ? 'active' : '' }}"><i class="fa fa-file-image me-2"></i>@lang('lang.main_gallery')</a>
                <a href="{{route('admin.review.index')}}" class="nav-item nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.review') ? 'active' : '' }}"><i class="fa fa-comments me-2"></i>@lang('lang.feedbacks')</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">

            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search">
            </form>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">

{{--                    @if($chats->count() > 0)--}}
{{--                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">--}}
{{--                            <i class="fa fa-envelope me-lg-2"></i>--}}
{{--                            <span class="d-none d-lg-inline-flex">Message</span>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">--}}
{{--                            @foreach($chats as $chat)--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <img class="rounded-circle" src="{{asset($from_user_data->profile_photo)}}" alt="" style="width: 40px; height: 40px;">--}}
{{--                                        <div class="ms-2">--}}
{{--                                            <h6 class="fw-normal mb-0">{{$from_user_data->name}} {{$from_user_data->surname}}</h6>--}}
{{--                                            <small>{{$differenceInDays}}</small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <hr class="dropdown-divider">--}}
{{--                            @endforeach--}}
{{--                            <a href="#" class="dropdown-item text-center">See all message</a>--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <a href="#" class="nav-link dropdown" >--}}
{{--                            <i class="fa fa-envelope me-lg-2"></i>--}}
{{--                            <span class="d-none d-lg-inline-flex">Message</span>--}}
{{--                        </a>--}}
{{--                    @endif--}}

                </div>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-globe me-lg-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <li class="dropbtnru"><a href="{{ $langru }}" class="dropdown-item">Русский</a></li>
                        <li class="dropbtnkg"><a href="{{ $langkg }}" class="dropdown-item">Кыргызча</a></li>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="{{auth()->user()->profile_photo != null ? asset(auth()->user()->profile_photo) : asset('new_template/img/avatar.png')}}" alt="" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">{{auth()->user()->name}} {{auth()->user()->surname}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="{{route('admin.profile', auth()->user()->id)}}" class="dropdown-item">@lang('lang.user_profile')</a>
                        <a href="{{route('index')}}" class="dropdown-item">@lang('lang.back_btn')</a>
                        <a href="{{route('user.logout')}}" class="dropdown-item">@lang('lang.log_out')</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
        <!-- Content Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>

    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
@yield('script')
<!-- JavaScript Libraries -->
<script>
    const links = document.querySelectorAll('.nav-link');

    if (links.length) {
        links.forEach((link) => {
            link.addEventListener('click', () => {
                links.forEach((navLink) => {
                    navLink.classList.remove('active');
                });
                link.classList.add('active');
            });
        });
    }
</script>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('admin_template/lib/chart/chart.min.js')}}"></script>
<script src="{{asset('admin_template/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('admin_template/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('admin_template/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('admin_template/lib/tempusdominus/js/moment.min.js')}}"></script>
<script src="{{asset('admin_template/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
<script src="{{asset('admin_template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<!-- Template Javascript -->
<script src="{{asset('admin_template/js/main.js')}}"></script>
<script>
    function showForm(){
        document.getElementById("addUserBtnId").className = "d-none";
        document.getElementById("addUserId").className = "bg-light rounded h-100 p-4";
    }
    function cancelForm(){
        document.getElementById("addUserId").className = "d-none";
        document.getElementById("addUserBtnId").className = "btn btn-primary";
    }
</script>
</body>

</html>

