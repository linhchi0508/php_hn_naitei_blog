@extends('admin.admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid row d-flex justify-content-center">
        <div class="col-7">
            <div class="text-center">
                <h1>{{ trans('admin.Create') }} {{ trans('admin.User') }}</h1>
            </div>
            <div>
                <form action="{{ route('store_user') }}" method="POST">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                               <li><i>{{ $error }}</i></li>
                            @endforeach
                        </ul>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label><b>{{ trans('admin.Username') }}</b></label>
                        <input class="form-control" name="username" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label><b>{{ trans('admin.Email') }}</b></label>
                        <input type="email" class="form-control" name="email" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label><b>{{ trans('admin.Password') }}</b></label>
                        <input type="password" class="form-control" name="password" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label><b>{{ trans('admin.RePassword') }}</b></label>
                        <input type="password" class="form-control" name="re_password" placeholder="" />
                    </div> 
                    <div class="form-group">
                        <label><b class="mr-3">{{ trans('Role') }}</b></label>
                        <select name="roles_id">
                            <option value="{{ config('ad.user') }}">{{ trans('admin.User') }}</option>
                            <option value="{{ config('ad.admin') }}">{{ trans('admin.Admin') }}</option>
                            <option value="{{ config('ad.inspector') }}">{{ trans('admin.Inspector') }}</option>
                        </select> 
                    </div>
                    <div class="form-group">
                        <label><b class="mr-3">{{ trans('admin.Status') }}</b></label>
                        <label class="radio-inline mr-3">
                            <input name="status" value="{{ config('ad.active') }}" checked="" type="radio">{{ trans('admin.Active') }}
                        </label>
                        <label class="radio-inline">
                            <input name="status" value="{{ config('ad.block') }}" type="radio">{{ trans('admin.Block') }}
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary mr-2">{{ trans('admin.Create') }}</button>
                        <button type="reset" class="btn  btn-secondary">{{ trans('admin.Reset') }}</button>
                    </div>
                <form>
            </div>
        </div>
    </div>
</div>
       
@endsection
