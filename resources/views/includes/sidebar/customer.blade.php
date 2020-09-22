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


{{-- ############# Start Manager Pane ########################################################### --}}