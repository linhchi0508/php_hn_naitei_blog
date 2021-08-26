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
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="new-postbox">
                                        <div class="more">
                                            <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                <ul>
                                                    <select name="status" id="category">
                                                        <option value="public"><i class="fa fa-pencil-square-o"></i>{{ trans('homepage.public') }}</option>
                                                        <option value="draft"><i class="far fa-sticky-note"></i>{{ trans('homepage.draft') }}</option>
                                                    </select>
                                                </ul>
                                            </div>
                                        </div>
                                        <figure><img src="{{ asset('bower_components/blog_template/images/resources/admin.jpg') }}" alt=""></figure>
                                        <div class="newpst-input">
                                            <label>{{ trans('homepage.title') }}</label>
                                            <input class="px-5" type="text" name="title">
                                            <textarea rows="2" placeholder="Share some what you are thinking?"></textarea>
                                        </div>
                                        <div class="attachments">
                                            <ul>
                                                <li>
                                                    <i class="fa fa-image"></i>
                                                    <label class="fileContainer"><input type="file" multiple></label>
                                                </li>
                                                <li>
                                                    <select name="category" id="category">
                                                        <option value=""></option>
                                                        <option value="volvo"></option>
                                                        <option value="saab"></option>
                                                        <option value="opel"></option>
                                                        <option value="audi"></option>
                                                    </select>
                                                </li>
                                            </ul>
                                            <button class="post-btn" type="submit" data-ripple="">{{ trans('homepage.create_post') }}</button>
                                        </div>
                                    </div>	
                                </form>
                            </div>
                            <div class="loadMore">
                                <div class="central-meta item">
                                    <div class="user-post">
                                        <div class="friend-info">
                                            <figure>
                                                <img src="{{ asset('bower_components/blog_template/images/resources/nearly1.jpg') }}" alt="">
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
                                                <ins><a href="#" title="">{{ trans('homepage.user_name') }}</a>
                                                <span><i class="fa fa-globe"></i> {{ trans('homepage.status') }}: {{ trans('homepage.time') }} </span>
                                            </div>
                                            <div class="post-meta">
                                                <figure >
                                                    <div id="demo"  class="carousel slide row"  data-ride="carousel"> 
                                                        <div class="carousel-inner col-12" >
                                                            <div class="carousel-item">
                                                                <img src="{{ asset('bower_components/blog_template/images/resources/userlist-1.jpg') }}" >
                                                            </div>
                                                            <div class="carousel-item active carousel-item-left">
                                                                <img src="{{ asset('bower_components/blog_template/images/resources/userlist-1.jpg') }}" >
                                                            </div>
                                                        </div>
                                                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                                            <span class="carousel-control-prev-icon"></span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#demo" data-slide="next">
                                                            <span class="carousel-control-next-icon"></span>
                                                        </a>
                                                    </div>
                                                </figure>												
                                                <div class="description">
                                                    <p>{{ trans('homepage.content') }}</p>
                                                </div>
                                                <div class="we-video-info">
                                                    <ul>
                                                        <li>
                                                            <div class="likes heart" title="Like/Dislike">❤ <span>2K</span></div>
                                                        </li>
                                                        <li>
                                                            <span class="comment" title="Comments">
                                                                <i class="fa fa-commenting"></i>
                                                                <ins>52</ins>
                                                            </span>
                                                        </li>
                                                    </ul>									
                                                </div>
                                            </div>
                                            <div class="coment-area" >
                                                <ul class="we-comet">
                                                    <li>
                                                        <div class="comet-avatar">
                                                            <img src="{{ asset('bower_components/blog_template/images/resources/nearly3.jpg') }}" alt="">
                                                        </div>
                                                        <div class="we-comment">
                                                            <h5><a href="#" title="">{{ trans('homepage.user_name') }}</a></h5>
                                                            <p>{{ trans('homepage.content') }}</p>
                                                            <div class="inline-itms">
                                                                <span>{{ trans('homepage.time') }}</span>
                                                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="comet-avatar">
                                                            <img src="{{ asset('bower_components/blog_template/images/resources/comet-4.jpg') }}" alt="">
                                                        </div>
                                                        <div class="we-comment">
                                                            <h5><a href="#" title="">{{ trans('homepage.user_name') }}</a></h5>
                                                            <p>{{ trans('homepage.content') }}.</p>
                                                            <div class="inline-itms">
                                                                <span>{{ trans('homepage.time') }}</span>
                                                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="post-comment">
                                                        <div class="comet-avatar">
                                                            <img src="{{ asset('bower_components/blog_template/images/resources/nearly1.jpg') }}" alt="">
                                                        </div>
                                                        <div class="post-comt-box">
                                                            <form method="post">
                                                                <textarea placeholder="Post your comment"></textarea>
                                                                <button type="submit"></button>
                                                            </form>	
                                                        </div>
                                                    </li>
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
    </div>	
</section>

@endsection
