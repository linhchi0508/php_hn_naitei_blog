@extends('admin.admin')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ trans('admin.User') }}
                    <small>{{ trans('admin.Edit') }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">
                <form action="{{ route('update_user', $userEdit->id) }}" method="POST">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i>{{ $error }}</i></li>
                            @endforeach
                        </ul>
                    @endif
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>{{ trans('admin.Username') }}</label>
                        <input class="form-control" name="username" value="{{ $userEdit->username }}" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Email') }}</label>
                        <input type="email" class="form-control" name="email" value="{{ $userEdit->email }}" readonly="" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Password') }}</label>
                        <input type="password" class="form-control" name="password" value="{{ $userEdit->password }}" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.RePassword') }}</label>
                        <input type="password" class="form-control" name="re_password" value="{{ $userEdit->password }}" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Role') }}:</label> <i>{{ $userEdit->role->name }}</i> {{ trans('admin.change_to') }}                        
                        <select name="roles_id">
                            <option value="1">{{ trans('admin.User') }}</option>
                            <option value="3">{{ trans('admin.Inspector') }}</option>
                        </select> 
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Status') }}:</label> 
                        <i>
                            @if ($userEdit->status == config('ad.active')) 
                                {{ trans('admin.Active') }} 
                            @else 
                                {{ trans('admin.Block') }}
                            @endif
                        </i> {{ trans('admin.change_to') }}
                        <label class="radio-inline">
                            <input name="status" value="{{ config('ad.active') }}" checked="" type="radio">{{ trans('admin.Active') }}
                        </label>
                        <label class="radio-inline">
                            <input name="status" value="{{ config('ad.block') }}" type="radio">{{ trans('admin.Block') }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-secondary">{{ trans('admin.Update') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ trans('admin.Reset') }}</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
