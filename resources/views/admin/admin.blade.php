<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('homepage.web_title') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('bower_components/blog_template/images/fav.png') }}" type="image/png" sizes="16x16"> 
    <link rel="stylesheet" href="{{ asset('bower_components/blog_template/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/blog_template/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/blog_template/css/toast-notification.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/blog_template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/blog_template/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/blog_template/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin/plugins/summernote/summernote-bs4.min.css') }}">
</head>
<body>
<div class="theme-layout">
    <div class="topbar stick">
        <div class="logo">
            <a title="" href="#"><img src="{{ asset('bower_components/blog_template/images/logo.png') }}" alt=""></a>
	    </div>
        <div class="top-area">
            <div class="top-search">
                <form method="post" class="">
                    @csrf
		            <input type="text">
		            <button data-ripple><i class="ti-search"></i></button>
                </form>
            </div>
            <div class="page-name">
	            {{ trans('homepage.newsfeed') }}
            </div>
            <ul class="setting-area">
                <li><a href="#" title="Home" data-ripple=""><i class="fa fa-home"></i></a></li>
                <li><a href="#" title="Languages" data-ripple=""><i class="fa fa-globe"></i></a>
                    <div class="dropdowns languages">
                        <div data-gutter="10" class="row">
                            <div class="col-md-3">
                                <ul class="dropdown-meganav-select-list-lang">
                                    <li><a href="{{ route('change-language', ['en']) }}"><img title="Image Title" alt="Image Alternative text" src="{{ asset('bower_components/blog_template/images/flags/UK.png') }}">{{ trans('homepage.english') }}</a></li>
							        <li><a href="{{ route('change-language', ['vi']) }}"><img title="Image Title" alt="Image Alternative text" src="{{ asset('bower_components/blog_template/images/flags/NAM.png') }}">{{ trans('homepage.vietnam') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="user-img">
                <h5>{{ Auth::user()->username }}</h5>
                @if (count(Auth::user()->images) > config('ad.zero'))
                    @foreach (Auth::user()->images as $image)
                        <img class="user-avatar-img" src="{{ asset($image->image_url) }}" alt="">
                    @endforeach
                @else
                    <img class="user-avatar-img" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                @endif
                <span class="status f-online"></span>
                <div class="user-setting">
                    <span class="seting-title">{{ trans('homepage.user_setting') }}</span>
                    <ul class="log-out">
                        <li><a href="#" title=""><i class="ti-user"></i>{{ trans('homepage.user_setting') }}</a></li>
                        <li><a href="{{ route('profile') }}" title=""><i class="ti-pencil-alt"></i>{{ trans('homepage.view_profile') }}</a></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" title="">
                                <i class="ti-power-off"></i>{{ trans('homepage.log_out') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('bower_components/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" class="nav-link">{{ trans('homepage.home') }}</a>
            </li>
        </ul>
    </nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-5 pb-3 mb-3 d-flex">
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href=" {{ route('list_user') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ trans('admin.dasboard') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{ trans('admin.User') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('create_user') }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>{{ trans('admin.Create_user') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=" {{ route('list_user') }}" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>{{ trans('admin.List_user') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<div class="content-wrapper">
    <div class="content-header">
    </div>
    <section class="content">
        @yield('content')
    </section>
</div>   
    <script src="{{ asset('bower_components/blog_template/js/main.min.js') }}"></script>
    <script src="{{ asset('bower_components/blog_template/js/jquery-stories.js') }}"></script>
    <script src="{{ asset('bower_components/blog_template/js/toast-notificatons.js') }}"></script>
    <script src="{{ asset('bower_components/blog_template/js/locationpicker.jquery.js') }}"></script>
    <script src="{{ asset('bower_components/blog_template/js/map-init.js') }}"></script>
    <script src="{{ asset('bower_components/blog_template/js/page-tourintro.js') }}"></script>
    <script src="{{ asset('bower_components/blog_template/js/page-tour-init.js') }}"></script>
    <script src="{{ asset('bower_components/blog_template/js/script.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('bower_components/admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('bower_components/admin/dist/js/pages/dashboard.js') }}"></script>
</body>	
</html>
