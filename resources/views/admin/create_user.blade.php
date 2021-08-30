@extends('admin.admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ trans('admin.User') }}
                    <small>{{ trans('admin.Create') }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">
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
                        <label>{{ trans('admin.Username') }}</label>
                        <input class="form-control" name="username" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Email') }}</label>
                        <input type="email" class="form-control" name="email" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Password') }}</label>
                        <input type="password" class="form-control" name="password" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.RePassword') }}</label>
                        <input type="password" class="form-control" name="re_password" placeholder="" />
                    </div> 
                    <div class="form-group">
                        <label>{{ trans('Role') }}</label>
                        <select name="roles_id">
                            <option value="{{ config('ad.user') }}">{{ trans('admin.User') }}</option>
                            <option value="{{ config('ad.admin') }}">{{ trans('admin.Admin') }}</option>
                            <option value="{{ config('ad.inspector') }}">{{ trans('admin.Inspector') }}</option>
                        </select> 
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Status') }}</label>
                        <label class="radio-inline">
                            <input name="status" value="{{ config('ad.active') }}" checked="" type="radio">{{ trans('admin.Active') }}
                        </label>
                        <label class="radio-inline">
                            <input name="status" value="{{ config('ad.block') }}" type="radio">{{ trans('admin.Block') }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-secondary">{{ trans('admin.Create') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ trans('admin.Reset') }}</button>
                <form>
            </div>
        </div>
    </div>
</div>
       
@endsection
