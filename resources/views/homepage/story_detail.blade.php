@extends('homepage.app')

@section('content')
    <section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">
                            <div class="col-lg-11">
                                <div class="central-meta item">
                                    <div class="user-post">
                                        <div class="friend-info">
                                            <figure>
                                                @foreach ($user->images as $image)
                                                    <img class="user-image" src="{{ asset($image->image_url) }}" alt="">
                                                @endforeach
                                            </figure>
                                            <div class="friend-name">
                                                <div class="more">
                                                    <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                        <ul>
                                                            <li>
                                                                <a class="btn btn-danger" href="{{ route('stories.edit', $story->id) }}">{{ trans('homepage.edit_post') }}</a>
                                                            </li>
                                                            <li>
                                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                                <button type="submit" data-id="{{ $story->id }}" action="{{ route('stories.destroy', $story->id)}}" class="btn btn-danger remove">{{ trans('homepage.delete') }}</button>
                                                            </li>
                                                            <li>
                                                                <a class="btn btn-danger" href="#">{{ trans('homepage.bookmark') }}</a>
                                                            </li>
                                                            @cannot('is-user')
                                                                <li>
                                                                    <a class="btn btn-danger" href="#">{{ trans('homepage.hide') }}</a>
                                                                </li>
                                                            @endcannot
                                                        </ul>
                                                    </div>
                                                    @can ('is-admin')
                                                        <a class="hide-story" id="hide-item" attr-story_id="{{ $story->id }}" href>{{ trans('homepage.hide') }}</a>
                                                    @endcan
                                                    @can ('is-inspector')
                                                        <a class="hide-story" id="hide-item" attr-story_id="{{ $story->id }}" href>{{ trans('homepage.hide') }}</a>
                                                    @endcan
                                                </div>
                                                <ins><h5><b><a class="text-primary" href="#" title="">{{ $story->user->username }}</a></b></h5></ins>
                                                <span><h6>{{ $story->status }} : {{ $story->created_at }}</h6></span>
                                            </div>
                                            <div class="post-meta">
                                                @if(count($story->images) > config('paginate.zero'))
                                                    <figure class="mb-5 mt-3">
                                                        @if(count($story->images) == config('paginate.one')) 
                                                            <img class="pb-5 mb-5 image-single"src="{{ asset( $story->images[0]->image_url ) }}" >
                                                        @endif
                                                        @if(count($story->images) > config('paginate.one'))
                                                            <div id="demo"  class="carousel slide row"  data-ride="carousel"> 
                                                                <div class="carousel-inner col-12" >
                                                                    <div class="carousel-item active">
                                                                        <img src="{{ asset( $story->images[0]->image_url ) }}" >
                                                                    </div>
                                                                    {{ $k = config('paginate.one') }}
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
                                                        @endif
                                                    </figure>	
                                                @endif	
                                                <div class="description">
                                                    <a href="{{ route('stories.show', [$story->id]) }}"><p><h6>{{ $story->content }}</h6></p></a><br>
                                                </div>
                                                <div class="we-video-info">
                                                    <ul>
                                                        <li>
                                                            <div action="{{ $story->id }}" data-path="{{ route('like', $story->id )}}" data-count="{{ $story->total_like }}" id="like-{{ $story->id }}" class="likes heart" title="Like">❤ <span class="like-count-{{ $story->id }}">{{ $story->total_like }}</span></div>
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
                                            <div class="coment-area">
                                                <ul class="we-comet">
                                                    @foreach($story->comments as $comment)
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
                                                                        <h5><a href="{{ route('user-detail', $story->users_id) }}" title="">{{ $comment->user->username }}</a></h5>
                                                                        <p class="cmt-content{{ $comment->id }}">{{ $comment->content }}</p>
                                                                        <div class="inline-itms" attr-story_id="{{ $story->id }}" attr-user_id="{{ Auth::id() }}" attr-id="{{ $comment->id }}">
                                                                            <span>{{ $comment->created_at }}</span>
                                                                            <a class="we-reply" href title="{{ trans('homepage.reply') }}"><i class="fa fa-reply"></i></a>
                                                                        </div>
                                                                        @if ($comment->users_id == Auth::id())
                                                                            <a class="edit-cmt" attr-cmt_id="{{ $comment->id }}" href="">{{ trans('homepage.edit') }}</a>
                                                                            <a class="delete-cmt" attr-cmt_id="{{ $comment->id }}" href="">{{ trans('homepage.delete') }}</a>
                                                                        @endif
                                                                        @can ('is-admin')
                                                                            <a class="hide-cmt" attr-id_cmt="{{ $comment->id }}" href="{{ route('hide-comment', $comment->id) }}">{{ trans('homepage.hide') }}</a>
                                                                        @endcan
                                                                        @can ('is-inspector')
                                                                            <a class="hide-cmt" attr-id_cmt="{{ $comment->id }}" href="{{ route('hide-comment', $comment->id) }}">{{ trans('homepage.hide') }}</a>
                                                                        @endcan
                                                                    </div>
                                                                </li>
                                                                @foreach ($story->comments as $item)
                                                                    @if ($item->parent == $comment->id && $item->status == config('number.one'))
                                                                        <li class="replied">
                                                                            <div class="comet-avatar">
                                                                                @if (count($item->user->images) != config('number.zero'))
                                                                                    <img class="cmt-image" src="{{ asset($item->user->images[0]->image_url) }}" alt="">
                                                                                @else
                                                                                    <img class="cmt-image" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                                                                @endif
                                                                            </div>
                                                                            <div class="we-comment">
                                                                                <h5><a href="{{ route('user-detail', $story->users_id) }}" title="">{{ $item->user->username }}</a></h5>
                                                                                <p class="cmt-content{{ $item->id }}">{{ $item->content }}</p>
                                                                                <div attr-story_id="{{ $story->id }}" attr-user_id="{{ Auth::id() }}" attr-id="{{ $comment->id }}">
                                                                                    <span>{{ $item->created_at }}</span>
                                                                                </div>
                                                                                @if ($item->users_id == Auth::id())
                                                                                    <a class="edit-cmt" attr-cmt_id="{{ $item->id }}" href>{{ trans('homepage.edit') }}</a>
                                                                                    <a class="delete-cmt" attr-cmt_id="{{ $item->id }}" href>{{ trans('homepage.delete') }}</a>
                                                                                @endif
                                                                                @can ('is-admin')
                                                                                    <a class="hide-cmt" attr-id_cmt="{{ $item->id }}" href="{{ route('hide-comment', $item->id) }}">{{ trans('homepage.hide') }}</a>
                                                                                @endcan
                                                                                @can ('is-inspector')
                                                                                    <a class="hide-cmt" attr-id_cmt="{{ $item->id }}" href="{{ route('hide-comment', $item->id) }}">{{ trans('homepage.hide') }}</a>
                                                                                @endcan   
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <div class="input-cmt{{ $comment->id }}"></div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    <div id="new-cmt{{ $story->id }}"></div>
                                                    @can ('is-active')
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
            </div>	
        </div>
    </section>

@endsection
