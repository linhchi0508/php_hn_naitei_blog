@extends('homepage.app')

@section('content')

<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-12">
                            <div class="central-meta">
                                <div class="title-block">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="align-left">
                                                <h5>Followers <span>{{ count($users) }}</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row merged20">
                                                <div class="col-lg-7 col-lg-7 col-sm-7">
                                                    <form method="post">
                                                        <input type="text" placeholder="Search Friend">
                                                        <button type="submit"><i class="fa fa-search"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="central-meta padding30">
                                <div class="row">
                                    @foreach ($users as $user)
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="friend-box">
                                            <figure>
                                                <img src="{{ asset('bower_components/blog_template/images/resources/frnd-cover1.jpg') }}" alt="">
                                            </figure>
                                            <div class="frnd-meta">
                                                @foreach($user->images as $image)
                                                    <img class="list_image" style="width:30px; height:30px; "src="{{ asset($image->image_url) }}"  alt="">
                                                @endforeach
                                                <div class="frnd-name">
                                                    <a href="#" title="">{{ $user->username }}</a>
                                                </div>
                                                <ul class="frnd-info">
                                                    <li><span>Followers:</span> {{ $user->total_follower }}</li>
                                                    <li><span>Followings:</span> {{ $user->total_following }}</li>
                                                    <li><span>Post:</span> {{ $user->total_story }}</li>
                                                </ul>
                                                <form action="{{ route('follow.destroy', $user->id)}}" method="Post">
                                                  @method('Delete')
                                                    @csrf
                                                    <button class="btn-danger d-flex follow" onclick="return confirm('Are you sure ?')">{{ trans('homepage.unfollow') }}</button>
                                                </form> 
                                                <div class="more-opotnz">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                    <ul>
                                                        <li><a href="#" title="">hide from friend list</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                  
                                </div>
                                <div class="lodmore">
                                    <span>Viewing 1-8 of 44 friends</span>
                                    <button class="btn-view btn-load-more"></button>
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

