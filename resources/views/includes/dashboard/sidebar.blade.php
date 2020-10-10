<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/speedLogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">@lang('site.website_name') @lang('site.website_name_b')</span>
    </a>
    <div class="sidebar">
        <!-- Sidebar -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  @include('includes.sidebar.' . currentAdminType())
            </ul>
        </nav>
    </div>
</aside>
