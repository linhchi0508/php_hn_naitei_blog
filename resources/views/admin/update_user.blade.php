@extends('admin.admin')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid row d-flex justify-content-center">
        <div class="col-7">
            <div class="text-center mb-2" >
                <h1>{{ trans('admin.User') }} {{ trans('admin.Edit') }}</h1>
            </div>
            <div >
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
                        <label><b>{{ trans('admin.Username') }}</b></label>
                        <input class="form-control" name="username" value="{{ $userEdit->username }}" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label><b>{{ trans('admin.Email') }}</b></label>
                        <input type="email" class="form-control" name="email" value="{{ $userEdit->email }}" readonly="" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label><b>{{ trans('admin.Password') }}</b></label>
                        <input type="password" class="form-control" name="password" value="{{ $userEdit->password }}" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label><b>{{ trans('admin.RePassword') }}</b></label>
                        <input type="password" class="form-control" name="re_password" value="{{ $userEdit->password }}" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label><b class="mr-2">{{ trans('admin.Role') }}:</b></label> 
                        <i>{{ $userEdit->role->name }}</i> {{ trans('admin.change_to') }}                        
                        <select name="roles_id">
                            <option value="1">{{ trans('admin.User') }}</option>
                            <option value="3">{{ trans('admin.Inspector') }}</option>
                        </select> 
                    </div>
                    <div class="form-group">
                        <label><b class="mr-2">{{ trans('admin.Status') }}:</b></label> 
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
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary mr-3">{{ trans('admin.Update') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ trans('admin.Reset') }}</button>
                    </div>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
