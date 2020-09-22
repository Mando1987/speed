{{-- ############# Start Manager Pane ########################################################### --}}
{{-- dashboard --}}
<li class="nav-item has-treeview">

    <a href="{{ route('dashboard.index') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            @lang('sidebar.dashboard.index')
        </p>
    </a>
</li>
{{-- dashboard --}}
{{-- customer --}}
<li class="nav-item has-treeview">
    <a href="{{ route('customer.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            @lang('sidebar.customer.index')

                <i class="fas fa-angle-left right"></i>

        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('customer.index') }}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>@lang('sidebar.customer.all')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('customer.create') }}" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>@lang('sidebar.customer.create')</p>
            </a>
        </li>

    </ul>
</li>
{{-- customer --}}
{{-- admins links --}}
<li class="nav-item has-treeview">
    <a href="{{ route('admin.index') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            @lang('sidebar.admin.index')
                <i class="fas fa-angle-left right"></i>
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
{{-- delegate  --}}
<li class="nav-item has-treeview">
    <a href="{{ route('delegate.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            @lang('sidebar.delegate.index')
                <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('delegate.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('sidebar.delegate.all')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('delegate.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('sidebar.delegate.create')</p>
            </a>
        </li>

    </ul>
</li>
{{-- delegate  --}}
{{-- places --}}
<li class="nav-item has-treeview">
    <a href="{{ route('place.index') }}" class="nav-link">
        <i class="nav-icon fa fa-map-marker"></i>
        <p>
            @lang('sidebar.place.index')
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('place.index') }}" class="nav-link">
                <i class="nav-icon fa fa-map-marker nav-icon"></i>
                <p>@lang('sidebar.place.all')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('place.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('sidebar.place.create')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('price.index') }}" class="nav-link">
                <i class="fa fa-euro nav-icon"></i>
                <p>@lang('sidebar.place.prices')</p>
            </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('price.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('sidebar.place.prices_add')</p>
            </a>
        </li>
    </ul>
</li>
{{-- places --}}
{{-- Orders  --}}
<li class="nav-item has-treeview">
    <a href="{{ route('order.index') }}" class="nav-link">
        <i class="nav-icon ion ion-bag"></i>
        <p>
            @lang('sidebar.order.index')
               <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('order.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('sidebar.order.all')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('order.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('sidebar.order.create')</p>
            </a>
        </li>
    </ul>
</li>
{{-- End Of Orders  --}}

<li class="nav-item has-treeview">
    <a href="{{ route('sellersouq.index') }}" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
            @lang('sidebar.sellersouq.index')
                <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('sellersouq.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('sidebar.sellersouq.all')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('sellersouq.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('sidebar.sellersouq.create')</p>
            </a>
        </li>

    </ul>
</li>

{{-- roles links --}}
<li class="nav-item has-treeview">
    <a href="{{ route('role.index') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            @lang('sidebar.role.index')
                <i class="fas fa-angle-left right"></i>
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
{{-- End Of roles  --}}

{{-- ############# Start Manager Pane ########################################################### --}}