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
                                        @if (count($user->images) > config('ad.zero'))
                                            @foreach ($user->images as $image)
                                                <img class="big_avatar" alt="author" src="{{ asset($image->image_url) }}">
                                            @endforeach
                                        @else
                                            <img class="big_avatar" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                        @endif
                                        </div>
                                        <div class="author-content">
                                            <a class="h4 author-name" href="#">{{ $user->username }}</a>
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
                                            <a class="" href="#">{{ trans('homepage.bookmark') }}</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{ route('list-user') }}">{{ trans('homepage.list-user') }}</a>
                                        </li>
                                        @if ($user->role_id == 2)
                                            <li>
                                                <a class="" href="{{ route('list_user') }}">{{ trans('homepage.user-manage') }}</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <div id="user-list-{{ $user->id }}">
                                        @if ( count($follower) == config('ad.zero') )
                                            <button type="submit"  data-id="{{ $user->id }}" action="{{ route('follow.add', $user->id)}}" class="btn btn-danger following">{{ trans('homepage.follow') }}</button>
                                        @else
                                            <button type="submit" data-id="{{ $user->id }}" action="{{ route('follow.destroy', $user->id)}}" class="btn btn-danger remove">{{ trans('homepage.unfollow') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20 d-flex justify-content-center" id="page-contents">
                            <div class="col-9">
                                <div class="loadMore">
                                    @foreach ($stories as $story)
                                        <div class="central-meta item">
                                            <div class="user-post">
                                                <div class="friend-info mt-5" id="story-list">
                                                    <figure>
                                                        @foreach ($story->user->images as $image)
                                                            <img class="user-image" src="{{ asset($image->image_url) }}" alt="">
                                                        @endforeach
                                                    </figure>
                                                    <div class="friend-name">
                                                        <div class="more">
                                                            <div class="more-post-optns">
                                                                <i class="ti-more-alt"></i>
                                                                <ul >
                                                                    <li>
                                                                        <a class="btn btn-danger" href="{{ route('stories.edit', $story->id) }}">{{ trans('homepage.edit_post') }}</a>
                                                                    </li>
                                                                    <li>
                                                                        <button type="submit" data-id="{{ $story->id }}" action="{{ route('stories.destroy', $story->id) }}" class="btn btn-danger remove">{{ trans('homepage.delete') }}</button>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-danger" href="#">{{ trans('homepage.bookmark') }}</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <ins><h5><b><a class="text-primary user-name" href="#" title="">{{ $story->user->username }}</a></b></h5>
                                                        <span class="story-date"><b><i class="fa fa-globe"></i> {{ $story->status }}: {{ $story->created_at }} </span></b><br>
                                                        <span>{{ trans('homepage.category') }} : {{ $story->category->name }}</span>
                                                    </div>
                                                    <div class="post-meta">
                                                        @if(count($story->images) > config('ad.zero'))
                                                            @if(count($story->images) == config('ad.one'))
                                                                <figure class="mb-5">
                                                                    <img class="image-single" src="{{ asset( $story->images[0]->image_url ) }}">
                                                                </figure>
                                                            @endif
                                                            @if(count($story->images) > 1)
                                                                <figure>
                                                                    <div id="demo"  class="carousel slide row"  data-ride="carousel"> 
                                                                        <div class="carousel-inner col-12" >
                                                                            <div class="carousel-item active">
                                                                                <img src="{{ asset( $story->images[0]->image_url ) }}" >
                                                                            </div>
                                                                            {{ $k = config('ad.one') }}
                                                                            @while ($k < count($story->images))
                                                                                <div class="carousel-item ">
                                                                                    <img src="{{ asset( $story->images[$k]->image_url ) }}" >
                                                                                </div>
                                                                                {{ $k++ }}
                                                                            @endwhile
                                                                        </div>
                                                                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                                                            <span class="carousel-control-prev-icon"></span>
                                                                        </a>
                                                                        <a class="carousel-control-next" href="#demo" data-slide="next">
                                                                            <span class="carousel-control-next-icon"></span>
                                                                        </a>
                                                                    </div>
                                                                </figure>
                                                            @endif
                                                        @endif												
                                                        <div class="description">
                                                            <a href="{{ route('stories.show', [$story->id]) }}"><p><h6>{{ $story->content }}</h6></p></a><br>
                                                        </div>
                                                        <div class="we-video-info">
                                                            <ul>
                                                                <li>
                                                                    <div class="likes heart" title="Like/Dislike">❤ <span>{{ $story->total_like }}</span></div>
                                                                </li>
                                                                <li>
                                                                    <span class="comment" title="Comments">
                                                                        <i class="fa fa-commenting"></i>
                                                                        <ins>{{ $story->total_comment }}</ins>
                                                                    </span>
                                                                </li>
                                                            </ul>									
                                                        </div>
                                                    </div>
                                                    <div class="coment-area" >
                                                        <ul class="we-comet">
                                                            @foreach($story->comments as $comment)
                                                                <li>
                                                                    <div class="comet-avatar">
                                                                        @foreach($comment->user->images as $image)
                                                                            <img src="{{ asset($image->image_url) }}" alt="">
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="we-comment">
                                                                        <h5><a href="#" title="">{{ $comment->user->username }}</a></h5>
                                                                        <p>{{ $comment->content }}</p>
                                                                        <div class="inline-itms">
                                                                            <span>{{ $comment->created_at}}</span>
                                                                            <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                            <li class="post-comment">
                                                                <div class="comet-avatar">
                                                                    <img src="{{ asset('bower_components/blog_template/images/resources/nearly1.jpg') }}" alt="">
                                                                </div>
                                                                <div class="post-comt-box">
                                                                    <form method="post">
                                                                        <textarea></textarea>
                                                                        <button type="submit"></button>
                                                                    </form>	
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
        </div>	
    </section>
</div>
@include('homepage.footer')
