<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | {{ __("ĐẠI HỌC QUỐC GIA TPHCM TRƯỜNG ĐẠI HỌC AN GIANG") }} - {{ __("AGU") }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ __("ĐẠI HỌC QUỐC GIA TPHCM TRƯỜNG ĐẠI HỌC AN GIANG") }} - {{ __("AGU") }}" name="description" />
        <meta content="Phan Minh Trung - trungminhphan@gmail.com" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ env('APP_URL') }}assets/backend/images/favicon.ico">
        @section('css') @show
        <!-- App css -->
        <link href="{{ env('APP_URL') }}assets/backend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ env('APP_URL') }}assets/backend/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ env('APP_URL') }}assets/backend/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ env('APP_URL') }}assets/backend/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <!-- Navigation Bar-->
        <header id="topnav" style="background-color:#0072c6;">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown d-none d-lg-block">
                            <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ app()->getLocale() }}.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">{{ $arr_lang[app()->getLocale()] }} <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                @foreach($arr_lang as $klang => $vlang)
                                @php
                                    $id = isset($id) ? $id : App\Http\Controllers\ObjectController::Id();
                                    $link = route(\Illuminate\Support\Facades\Route::currentRouteName(), array($klang, $id));
                                @endphp
                                    <a href="{{ $link }}" class="dropdown-item notify-item">
                                        <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">{{ $vlang }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </li>
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ env('APP_URL') }}assets/backend/images/logo-sm.png" alt="{{ Session::get('user.name') }}" alt="{{ Session::get('user.username') }}" class="rounded-circle">
                                <span class="pro-user-name ml-1">{{ Session::get('user.username') }}<i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
                                @if(Session::get('user.roles') && in_array('Admin', Session::get('user.roles')))
                                <a href="{{ env('APP_URL') . app()->getLocale() }}/admin/user" class="dropdown-item notify-item">
                                    <i class="fe-user"></i> <span>{{ __("Accounts") }}</span>
                                </a>
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate" class="dropdown-item notify-item">
                                    <i class="fas fa-language"></i> <span>{{ __('Translate') }}</span>
                                </a>
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/translate-path" class="dropdown-item notify-item">
                                    <i class="fas fa-code-branch"></i> <span>{{ __('Translate Path') }}</span>
                                </a>
                                @endif
                                <a href="{{ env('APP_URL') . app()->getLocale() }}/auth/logout" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i> <span>{{ __("Logout") }}</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="{{ env('APP_URL') }}admin" class="logo text-center">
                            <span class="logo-lg">
                                <img src="{{ env('APP_URL') }}assets/backend/images/logo_{{ app()->getLocale() }}.jpg" title="{{ __("ĐẠI HỌC QUỐC GIA TPHCM TRƯỜNG ĐẠI HỌC AN GIANG") }} - {{ __("AGU") }}" height="40">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ env('APP_URL') }}assets/backend/images/logo-sm.png" alt="" height="26">
                            </span>
                        </a>
                    </div>
                </div> <!-- end container-fluid-->
            </div>
            <!-- end Topbar -->
            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li>
                                <a href="{{ env('APP_URL') . app()->getLocale() }}/admin/banner"><i class="far fa-images"></i> {{ __('Banner') }}</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="far fa-file-alt"></i> {{ __('Giới thiệu') }} <div class="arrow-down"></div> </a>
                                <ul class="submenu">
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/tong-quan">{{ __('Tổng quan') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/nhan-su">{{ __('Nhân sự') }}</a></li>
                                    {{-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/chuyen-gia">{{ __('Chuyên gia') }}</a></li> --}}
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/lien-he">{{ __('Liên hệ') }}</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="{{ env('APP_URL') . app()->getLocale() }}/admin/tin-tuc-su-kien"><i class="far fa-newspaper"></i> {{ __('Tin tức - Sự kiện') }}</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fab fa-xbox"></i> {{ __('Nghiên cứu') }} <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nghien-cuu-khoa-hoc">{{ __('Nhiệm vụ Khoa học Công nghệ') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/khoa-luan-tot-nghiep">{{ __('Khóa luận tốt nghiệp') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/du-an">{{ __('Dự án') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/hoi-nghi-hoi-thao">{{ __('Hội nghị - Hội thảo') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/van-ban">{{ __('Văn bản') }}</a></li>
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/doi-tac">{{ __('Đối tác') }}</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fab fa-xbox"></i> {{ __('Đào tạo') }} <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nganh-dao-tao">{{ __('Ngành đào tạo') }}</a></li>
        
                                </ul>
                            </li>

                        </ul>
                        <!-- End navigation menu -->
                        <div class="clearfix"></div>
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container-fluid">
                <!-- start page title -->
                @section('body') @show
            </div>
        </div>
        <!-- end wrapper -->
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
          <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        &copy; 2022 {{ __('Đại học Quốc gia TPHCM Trường Đại học An Giang') }}
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
        <!-- Vendor js -->
        <script src="{{ env('APP_URL') }}assets/backend/js/vendor.min.js"></script>
        @section('js') @show
        <!-- App js -->
        <script src="{{ env('APP_URL') }}assets/backend/js/app.min.js"></script>
    </body>
</html>
