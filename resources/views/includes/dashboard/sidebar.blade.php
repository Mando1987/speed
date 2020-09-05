<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(adminIsManager())

                    {{-- ############# Start Manager Pane ########################################################### --}}
                    <li class="nav-item has-treeview">
                        <a href="{{ route('customer.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                @lang('sidebar.customer.index')

                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('customer.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('sidebar.customer.all')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('sidebar.customer.create')</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{-- ############# Start Manager Pane ########################################################### --}}
                @else

                    <li class="nav-item has-treeview">

                        <a href="{{ route('dashboard.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                @lang('sidebar.dashboard.index')
                            </p>
                        </a>

                    </li>
                    {{-- admins links --}}

                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                @lang('sidebar.admin.index')

                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('admin_index')
                                <li class="nav-item">
                                    <a href="{{ route('admin.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('sidebar.admin.all')</p>
                                    </a>
                                </li>
                            @endcan

                            @can('admin_create')

                            <li class="nav-item">
                                <a href="{{ route('admin.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('sidebar.admin.create')</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    {{-- roles links --}}

                    <li class="nav-item has-treeview">
                        <a href="{{ route('role.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                @lang('sidebar.role.index')

                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('role_index')
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('sidebar.role.all')</p>
                                    </a>
                                </li>
                            @endcan

                            @can('role_create')

                            <li class="nav-item">
                                <a href="{{ route('role.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('sidebar.role.create')</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
