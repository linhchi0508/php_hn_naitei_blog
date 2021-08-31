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
                                <div class="about">
                                    <div class="d-flex flex-row mt-2">
                                        <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" >
                                            <li class="nav-item">
                                                <a href="#edit-profile" class="nav-link" data-toggle="tab" ><i class="fa fa-pencil"></i>{{ trans('homepage.edit_profile') }}</a>
                                            </li>	
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="edit-profile" >
                                                <div class="set-title">
                                                    <h5>{{ trans('homepage.edit_profile') }}</h5>
                                                </div>
                                                <form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="setting-meta">
                                                        <div class="change-photo">
                                                            <figure>
                                                                @if (count(Auth::user()->images) != config('number.zero'))
                                                                    <img id="img-pre" class="user-img-change-profile" src="{{ asset(Auth::user()->images[0]->image_url) }}" alt="">
                                                                @else
                                                                    <img id="img-pre" class="user-img-change-profile" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
                                                                @endif
                                                            </figure>
                                                            <div class="edit-img">
                                                                <div class="edit-phto">
                                                                    <label class="fileContainer">
                                                                        <i class="fa fa-camera-retro"></i>
                                                                        {{ trans('homepage.change_avatar') }}
                                                                        <input class="input-img" type="file" name="image">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="stg-form-area">
                                                        <div class="c-form">
                                                            <div>
                                                                <label>{{ trans('homepage.username') }}</label>
                                                                <input type="text" id="username-profile"  name= "username" value="{{ Auth::user()->username }}">
                                                            </div>
                                                            <div>
                                                                <label>{{ trans('homepage.email') }}</label>
                                                                <input type="email" id="email-profile" name="email" value="{{ Auth::user()->email }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input class="edit-button" type="submit" value="{{ trans('homepage.edit') }}">
                                                    </div>
                                                </form>
                                            </div><!-- edit profile -->
                                        </div><!-- apps -->
                                    </div>
                                </div>
                            </div>	
                        </div><!-- centerl meta -->
                    </div>	
                </div>
            </div>
        </div>
    </div>	
</section>
@endsection
