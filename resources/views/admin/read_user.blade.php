@extends('admin.admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid row d-flex justify-content-center">
        <div class="col-7">
            <div class="col-8 ml-5 pl-5">
                <h1 class="ml-5 mb-4">{{ trans('admin.User') }} {{ trans('admin.Read') }}</h1>
            </div>
            <div class="row  d-flex justify-content-center">
                <div class="col-3 mr-5">
                    @if (count($detailUser->images) != config('ad.zero'))
                        @foreach ($detailUser->images as $image)
                            <img src="{{ asset($image->image_url) }}" class="img-circle elevation-2" alt="User Image">
                        @endforeach
                    @else
                        <img src="{{ asset('bower_components/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    @endif
                </div>
                <div class="col-">                        
                    <div class="form-group">
                        <label>{{ trans('admin.Username') }}</label>
                        <div class="text-primary">{{ $detailUser->username }}</div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Email') }}</label>
                        <div class="text-primary">{{ $detailUser->email }}</div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Password') }}</label>
                        <div class="text-primary">{{ $detailUser->password }}</div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Role') }}</label>
                        <div class="text-primary">{{ $detailUser->role->name }}</div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Status') }}</label>
                        <div>
                            @if ($detailUser->status == config('ad.active')) 
                                <font color="green"><b>{{ trans('admin.Active') }}</b></font>
                            @else 
                                <font color="red"><b>{{ trans('admin.Block') }}</b></font>
                            @endif
                        </div>
                    </div>         
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
