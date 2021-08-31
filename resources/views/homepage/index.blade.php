@extends('homepage.app')

@section('content')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-3">
                            <aside class="sidebar static left">
                                <div class="widget">
                                    <div class="weather-widget low-opacity bluesh">
                                        <div class="bg-image" ></div>
                                        <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                                        <div class="weather-week">
                                            <div class="icon sun-shower">
                                                <div class="cloud"></div>
                                                <div class="sun">
                                                    <div class="rays"></div>
                                                </div>
                                                <div class="rain"></div>
                                            </div>
                                        </div>
                                        <div class="weather-infos">
                                            <span class="weather-tem">25</span>
                                            <h3>{{ trans('homepage.cloudy') }}</h3>
                                            <div class="weather-date skyblue-bg">
                                                <span>{{ trans('homepage.may') }}<strong>21</strong></span>
                                            </div>
                                        </div>
                                        <div class="monthly-weather">
                                            <ul>
                                                <li>
                                                    <span>{{ trans('homepage.sun') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-sunny"></i></a>
                                                    <em>40°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.mon') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-cloudy"></i></a>
                                                    <em>10°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.tue') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-hail"></i></a>
                                                    <em>20°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.web') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-lightning"></i></a>
                                                    <em>34°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.thu') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-showers"></i></a>
                                                    <em>22°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.fri') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-windy"></i></a>
                                                    <em>26°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.sat') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-sunny-overcast"></i></a>
                                                    <em>30°</em>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget stick-widget">
                                    <h4 class="widget-title">{{ trans('homepage.who_follow') }}</h4>
                                    <ul class="followers">
                                        <li>
                                            <figure><img src="{{ asset('bower_components/blog_template/images/resources/friend-avatar2.jpg') }}" alt=""></figure>
                                            <div class="friend-meta">
                                                <h4><a href="#" title="">{{ trans('homepage.user_name') }}</a></h4>
                                                <a href="#" title="" class="underline">{{ trans('homepage.follow') }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <figure><img src="{{ asset('bower_components/blog_template/images/resources/friend-avatar4.jpg') }}" alt=""></figure>
                                            <div class="friend-meta">
                                                <h4><a href="#" title="">{{ trans('homepage.user_name') }}</a></h4>
                                                <a href="#" title="" class="underline">{{ trans('homepage.follow') }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-8">
                            <div class="central-meta postbox">
                                <span class="create-post">{{ trans('homepage.create_post') }}</span>
                                <form action="{{ route('stories.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="new-postbox">
                                        <figure>
                                            @if (count(Auth::user()->images) != config('number.zero'))
                                                <img class="user-post-img" src="{{ asset(Auth::user()->images[0]->image_url) }}" alt="">
                                            @else
                                                <img class="user-post-img" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                            @endif
                                        </figure>
                                        <div class="newpst-input">
                                            <textarea rows="2" placeholder="{{ trans('homepage.message_content') }}" name="content"></textarea>
                                            @if ($errors->has('content'))
                                                <div class="modal fade" id="dialog1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ trans('homepage.alert_title') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{ $errors->first('content') }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('homepage.alert_close') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="attachments">
                                            <ul>
                                                <li>
                                                    <i class="fa fa-image"></i>
                                                    <label class="fileContainer"><input type="file"  name="photos[]" multiple></label>
                                                </li>
                                                <li>
                                                    <select name="category" id="category">
                                                        @foreach( $categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </li>
                                                <li>
                                                    <select name="status" id="status">
                                                        <option value="public"><i class="fa fa-pencil-square-o"></i>{{ trans('homepage.public') }}</option>
                                                        <option value="draft"><i class="far fa-sticky-note"></i>{{ trans('homepage.draft') }}</option>
                                                    </select>
                                                </li>
                                            </ul>
                                            <button class="post-btn" type="submit" data-ripple="">{{ trans('homepage.create_post') }}</button>
                                        </div>
                                    </div>	
                                </form>
                            </div>
                            <div class="loadMore">
                                @foreach ($stories as $story)
                                    <div class="central-meta item">
                                        <div class="user-post">
                                            <div class="friend-info mt-5" id="story-list">
                                                <figure>
                                                    @if (count(Auth::user()->images) != config('number.zero'))
                                                        <img class="user-image" src="{{ asset(Auth::user()->images[0]->image_url) }}" alt="">
                                                    @else
                                                        <img class="user-image" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                                    @endif
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
                                                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                                                    <button type="submit" data-id="{{ $story->id }}" action="{{ route('stories.destroy', $story->id)}}" class="btn btn-danger remove">{{ trans('homepage.delete') }}</button>
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
                                                    @if(count($story->images) > 0)
                                                        @if(count($story->images) == 1)
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
                                                                        {{ $k = 1 }}
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
                                                        @foreach ($story->comments as $comment)
                                                            @if ($comment->status == config('number.one'))
                                                                @if ($comment->parent == null)
                                                                    <!-- display parent comment -->
                                                                    <li>
                                                                        <div class="comet-avatar">
                                                                            @if (count($comment->user->images) != config('number.zero'))
                                                                                <img class="cmt-image" src="{{ asset($comment->user->images[0]->image_url) }}" alt="">
                                                                            @else
                                                                                <img class="cmt-image" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                                                            @endif
                                                                        </div>
                                                                        <div class="we-comment">
                                                                            <h5><a href title="">{{ $comment->user->username }}</a></h5>
                                                                            <p>{{ $comment->content }}</p>
                                                                            <div class="inline-itms" attr-story_id="{{ $story->id }}" attr-user_id="{{ Auth::id() }}" attr-id="{{ $comment->id }}">
                                                                                <span>{{ $comment->created_at}}</span>
                                                                                <a class="we-reply" href title="{{ trans('homepage.reply') }}"><i class="fa fa-reply"></i></a>
                                                                            </div>    
                                                                        </div>
                                                                    </li>
                                                                    <!-- display comment child -->
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
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </div>	
</section>

@endsection
