@extends('admin.admin')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ trans('admin.User') }}
                    <small>{{ trans('admin.Read') }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">                        
                <div class="form-group">
                    <label>{{ trans('admin.Username') }}</label>
                    <div>{{ $detailUser->username }}</div>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.Email') }}</label>
                    <div>{{ $detailUser->email }}</div>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.Password') }}</label>
                    <div>{{ $detailUser->password }}</div>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.Role') }}</label>
                    <div>{{ $detailUser->role->name }}</div>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.Status') }}</label>
                    <div>
                        @if ($detailUser->status == config('ad.active')) 
                            <font color="green">{{ trans('admin.Active') }}</font>
                        @else 
                            <font color="red">{{ trans('admin.Block') }}</font>
                        @endif
                    </div>
                </div>         
            </div>
        </div>
    </div>
</div>

@endsection
