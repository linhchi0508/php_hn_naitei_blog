@extends('homepage.app')

@section('content')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-4 col-md-4">
                            <aside class="sidebar">
                            <div class="central-meta stick-widget">
                                <span class="create-post">{{ trans('homepage.personal_info') }}</span>
                                <div class="personal-head">
                                    <span class="f-title"><i class="fa fa-user"></i>{{ trans('homepage.about_me') }}</span>
                                    <span class="f-title"><i class="fa fa-medkit"></i>{{ trans('homepage.email') }}</span>
                                    <p>
                                        {{ Auth::user()->email }}
                                    </p>
                                    <span class="f-title"><i class="fa fa-male"></i>{{ trans('homepage.username') }}</span>
                                    <p>
                                        {{ Auth::user()->username }}
                                    </p>
                                    <span class="f-title">
                                    <a href="{{ route('edit-profile') }}"><i class="fa fa-pencil"></i>{{ trans('homepage.edit_profile') }}</a>   
                                </div>
                            </div>
                            </aside>	
                        </div>	
                        <div class="col-lg-8 col-md-8">
                            <div class="loadMore">
                                @if (count($stories) != config('number.zero'))
                                    @foreach ($stories as $story)
                                        <div class="central-meta item">
                                            <div class="user-post">
                                                <div class="friend-info">
                                                    <figure>
                                                        @if (count(Auth::user()->images) > config('number.zero'))
                                                            <img src="{{ asset(Auth::user()->images[0]->image_url) }}" alt="">
                                                        @else 
                                                            <img src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                                        @endif
                                                    </figure>
                                                    <div class="friend-name">
                                                        <div class="more">
                                                            <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                                <ul>
                                                                    <li><i class="fa fa-pencil-square-o"></i>{{ trans('homepage.edit_post') }}</li>
                                                                    <li><i class="fa fa-trash-o"></i>{{ trans('homepage.delete_post') }}</li>
                                                                    <li><i class="far fa-bookmark"></i>{{ trans('homepage.bookmark') }}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <ins><a href="" title="">{{ Auth::user()->username }}</a>
                                                        <span><i class="fa fa-globe"></i>{{ trans('homepage.status') }}: {{ $story->created_at }} </span>
                                                    </div>
                                                    <div class="post-meta">
                                                        @if (count($story->images) != config('number.zero'))
                                                            <figure class="profile-post-img">
                                                                <div id="demo"  class="carousel slide row"  data-ride="carousel"> 
                                                                    <div class="carousel-inner col-12" >
                                                                        <div class="carousel-item">
                                                                            <img class="post-pf-carousel-img" src="{{ asset($story->images[0]->image_url) }}">
                                                                        </div>
                                                                        @foreach ($story->images as $img)
                                                                        <div class="carousel-item active carousel-item-left">
                                                                            <img class="post-pf-carousel-img" src="{{ asset($img->image_url) }}">
                                                                        </div>
                                                                        @endforeach
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
                                                        <div class="description">
                                                            <p>
                                                                {{ $story->content }}
                                                            </p>
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
                                                    <div class="coment-area" style="">
                                                        <ul class="we-comet">
                                                            <li>
                                                                <div class="comet-avatar">
                                                                    <img src="{{ asset('bower_components/blog_template/images/resources/nearly3.jpg') }}" alt="">
                                                                </div>
                                                                <div class="we-comment">
                                                                    <h5><a href="#" title="">Jason borne</a></h5>
                                                                    <p>we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel</p>
                                                                    <div class="inline-itms">
                                                                        <span>1 year ago</span>
                                                                        <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                        <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                                                    </div>
                                                                </div>

                                                            </li>
                                                            <li>
                                                                <div class="comet-avatar">
                                                                    <img src="{{ asset('bower_components/blog_template/images/resources/comet-4.jpg ') }}" alt="">
                                                                </div>
                                                                <div class="we-comment">
                                                                    <h5><a href="#" title="">Sophia</a></h5>
                                                                    <p>we are working for the dance and sing songs. this video is very awesome for the youngster.
                                                                        
                                                                    </p>
                                                                    <div class="inline-itms">
                                                                        <span>1 year ago</span>
                                                                        <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                        <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <a href="#" title="" class="showmore underline">{{ trans('homepage.more_comment') }}+</a>
                                                            </li>
                                                            <li class="post-comment">
                                                                <div class="comet-avatar">
                                                                    <img src="{{ asset('bower_components/blog_template/images/resources/nearly1.jpg') }}" alt="">
                                                                </div>
                                                                <div class="post-comt-box">
                                                                    <form method="post">
                                                                        <textarea placeholder="{{ trans('homepage.post_your_comment') }}"></textarea>
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
                                @endif
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </div>	
</section>
@endsection
