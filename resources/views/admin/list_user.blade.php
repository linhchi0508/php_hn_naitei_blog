@extends('admin.admin')
@section('content')
<div class="row">
    <div class="col-lg-6 col-6">
        <div class="small-box bg-info d-flex justify-content-between">
            <div class="inner">
                <h3>{{ count($all) }}</h3>
                <h1>{{ trans('admin.User') }}</h1>
            </div>
            <div class="icon">
                <i class="fas fa-user-friends"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-6">
        <div class="small-box bg-success d-flex justify-content-between">
            <div class="inner">
                <h3>{{ $allStory }}</h3>
                <h1>{{ trans('homepage.story') }}</h1>
            </div>
            <div class="icon">
                <i class="fal fa-address-book"></i>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <section class="col-lg-8 connectedSortable">
            <div class="row">
                <div class="col-lg-12 text-center mb-3">
                    <h1>{{ trans('admin.User') }}</h1>
                </div>
                <table class="table table-dark table-striped" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th class="fs-1">{{ trans('admin.Username') }}</th>
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
                                    <button><a href="{{ route('edit_user', $li->id) }}"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">{{ $list->links() }}</div>
            </div>
        </section>
        <section class="col-lg-4 connectedSortable">
            <div class="card bg-gradient-primary">
                <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-map-marker-alt mr-1"></i></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                            <i class="far fa-calendar-alt"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="world-map"></div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="row">
                        <div class="col-4 text-center">
                            <div id="sparkline-1"></div>
                                <div class="text-white"></div>
                            </div>
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white"></div>
                            </div>
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
