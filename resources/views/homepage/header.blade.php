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
    <script src="{{ asset('js/app.js') }}" defer></script>
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
		            <input type="text" placeholder="Search People, Pages, Groups etc">
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
                @if (count(Auth::user()->images) > config('number.zero'))
                    <img class="user-avatar-img" src="{{ asset(Auth::user()->images[0]->image_url) }}" alt="">
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row merged20" id="page-contents">
                    <div class="user-profile">
                        <figure>
                            <img src="{{ asset('bower_components/blog_template/images/resources/profile-image.jpg') }}" alt="">
                        </figure>
                        <div class="profile-section">
                            <div class="row">
                                <div class="col-lg-2 col-md-3">
                                    <div class="profile-author">
                                        <div class="profile-author-thumb">
                                        @if (count(Auth::user()->images) > config('ad.zero'))
                                            @foreach (Auth::user()->images as $image)
                                                <img class="big_avatar" alt="author" src="{{ asset($image->image_url) }}">
                                            @endforeach
                                        @else
                                            <img class="big_avatar" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                        @endif
                                        </div>
                                        <div class="author-content">
                                            <a class="h4 author-name" href="#">{{ Auth::user()->username }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="profile-menu">
                                        <li>
                                            <a class="" href="{{ route('home') }}">{{ trans('homepage.timeline') }}</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{ route('profile') }}">{{ trans('homepage.profile') }}</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{ route('follow.follower') }}">{{ trans('homepage.follower') }}</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{ route('follow.following') }}">{{ trans('homepage.following') }}</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{ route('list_bookmark') }}">{{ trans('homepage.bookmark') }}</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{ route('list-user') }}">{{ trans('homepage.list-user') }}</a>
                                        </li>
                                        @can ('is-admin')
                                            <li>
                                                <a class="" href="{{ route('list_user') }}">{{ trans('homepage.user-manage') }}</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </div>
