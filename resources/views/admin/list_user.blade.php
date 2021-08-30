@extends('admin.admin')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ trans('admin.User') }}
                    <small>{{ trans('admin.List') }} ({{ count($all) }})</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>{{ trans('admin.Username') }}</th>
                        <th>{{ trans('admin.Email') }}</th>
                        <th>{{ trans('admin.Role') }}</th>
                        <th>{{ trans('admin.Status') }}</th>
                        <th>{{ trans('admin.Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $li)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $li->username }}</td>
                        <td>{{ $li->email }}</td>
                        <td>{{ $li->role->name }}</td>
                        <td>
                            @if ($li->status == config('ad.active')) 
                                <font color="green">{{ trans('admin.Active') }}</font>
                            @else 
                                <font color="red">{{ trans('admin.Block') }}</font>
                            @endif
                        </td>
                        <td class="center">
                            <button><a href="{{ route('read_user', $li->id) }}"><i class="fa fa-eye"></i></button>
                            <button><a href="{{ route('edit_user', $li->id) }}"><i class="fa fa-pencil"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">{{ $list->links() }}</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
