@include('homepage.header')	

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i>{{ trans('admin.Dashboard') }}</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i>{{ trans('admin.User') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('list_user') }}">{{ trans('admin.List_user') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('create_user') }}">{{ trans('admin.Create_user') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

@yield('content')

</div>
