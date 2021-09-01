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
                                                            @foreach ($story->comments as $comment)
                                                                @if ($comment->status == config('number.one'))
                                                                    @if ($comment->parent == null)
                                                                        <li>
                                                                            <div class="comet-avatar">
                                                                                @if (count($comment->user->images) != config('number.zero'))
                                                                                    <img class="cmt-image" src="{{ asset($comment->user->images[0]->image_url) }}" alt="">
                                                                                @else
                                                                                    <img class="cmt-image" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                                                                @endif
                                                                            </div>
                                                                            <div class="we-comment">
                                                                                <h5><a href="#" title="">{{ $comment->user->username }}</a></h5>
                                                                                <p>{{ $comment->content }}</p>
                                                                                <div class="inline-itms" attr-story_id="{{ $story->id }}" attr-user_id="{{ Auth::id() }}" attr-id="{{ $comment->id }}">
                                                                                    <span>{{ $comment->created_at }}</span>
                                                                                    <a class="we-reply" href="#" title="{{ trans('homepage.reply') }}"><i class="fa fa-reply"></i></a>
                                                                                </div>
                                                                                @if ($comment->users_id == Auth::id())
                                                                                    <a class="edit-cmt" attr-cmt_id="{{ $comment->id }}" href="">{{ trans('homepage.edit') }}</a>
                                                                                    <a class="delete-cmt" attr-cmt_id="{{ $comment->id }}" href="">{{ trans('homepage.delete') }}</a>
                                                                                @endif
                                                                            </div>
                                                                        </li>
                                                                        @foreach ($story->comments as $item)
                                                                            @if ($item->parent == $comment->id)
                                                                                <li class="replied">
                                                                                    <div class="comet-avatar">
                                                                                        @if (count($item->user->images) != config('number.zero'))
                                                                                            <img class="cmt-image" src="{{ asset($item->user->images[0]->image_url) }}" alt="">
                                                                                        @else
                                                                                            <img class="cmt-image" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="we-comment">
                                                                                        <h5><a href title="">{{ $item->user->username }}</a></h5>
                                                                                        <p class="cmt-content{{ $item->id }}">{{ $item->content }}</p>
                                                                                        <div attr-story_id="{{ $story->id }}" attr-user_id="{{ Auth::id() }}" attr-id="{{ $comment->id }}">
                                                                                            <span>{{ $item->created_at }}</span>
                                                                                        </div>
                                                                                        @if ($item->users_id == Auth::id())
                                                                                            <a class="edit-cmt" attr-cmt_id="{{ $item->id }}" href>{{ trans('homepage.edit') }}</a>
                                                                                            <a class="delete-cmt" attr-cmt_id="{{ $item->id }}" href>{{ trans('homepage.delete') }}</a>
                                                                                        @endif
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="input-cmt{{ $comment->id }}"></div>
                                                                    @endif
                                                                @endif
                                                            @endforeach

                                                            <div id="new-cmt{{ $story->id }}"></div>
                                                            <li class="post-comment">
                                                                <div class="comet-avatar">
                                                                    @if (count(Auth::user()->images) != config('number.zero'))
                                                                        <img class="cmt-image" src="{{ asset(Auth::user()->images[0]->image_url) }}" alt="">
                                                                    @else
                                                                        <img class="cmt-image" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                                                    @endif
                                                                </div>
                                                                <div class="post-comt-box" attr-story_id="{{ $story->id }}" attr-user_id="{{ Auth::id() }}">
                                                                    <form>
                                                                        <input id="pacmt{{ $story->id }}" class="cmt pacmt" attr-story_id="{{ $story->id }}" attr-user_id="{{ Auth::id() }}" placeholder="{{ trans('homepage.post_your_comment') }}" type="text">
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
