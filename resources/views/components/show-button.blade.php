@can($ability)
<a class="btn btn-primary btn-sm mr-2 showSingleModel" href="{{ route( $route, $id) }}">
    <span class="d-none d-md-block">
        <i class="fas fa-eye"></i>
        @lang('site.show')
    </span>
    <span class="d-block d-md-none"><i class="fas fa-eye"></i></span>
</a>
@else
<a class="btn btn-primary btn-sm mr-2 disabled" href="">
    <span class="d-none d-md-block">
        <i class="fas fa-eye"></i>
        @lang('site.show')
    </span>
    <span class="d-block d-md-none"><i class="fas fa-eye"></i></span>
</a>
@endcan
