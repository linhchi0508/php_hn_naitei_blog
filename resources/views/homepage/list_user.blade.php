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
                                                <h5>{{ trans('homepage.user') }}<span>{{ count($users) }}</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="central-meta padding30">
                                <div class="row merged20">
                                    @foreach ($users as $user)
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="friend-block">
                                                <figure>
                                                    @if (count($user->images) != config('ad.zero'))
                                                        <img class="list-user" src="{{ asset($user->images[0]->image_url) }}" alt="">
                                                    @else
                                                        <img class="list-user" src="{{ asset('bower_components/blog_template/images/resources/frnd-figure2.jpg') }}" alt="">
                                                    @endif
                                                </figure>
                                                <div class="frnd-meta">
                                                    <h5 class="text-primary">{{ $user->username}}</a></h5><br>
                                                    <a class="" href="{{ route('user-detail', $user->id)}}" title="">{{ trans('homepage.view_more') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="lodmore">
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
