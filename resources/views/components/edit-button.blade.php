@can($ability)
<a class="btn btn-info btn-sm mr-2" href="{{ route($route , $id) }}">
    <span class="d-none d-md-block">
        <i class="fas fa-pencil-alt"></i>
        {{-- @lang('site.edit') --}}
    </span>
    <span class="d-block d-md-none"><i class="fas fa-pencil-alt"></i></span>
</a>
@else
<a class="btn btn-info btn-sm mr-2 disabled" href="#">
    <span class="d-none d-md-block">
        <i class="fas fa-pencil-alt"></i>
        @lang('site.edit')
    </span>
    <span class="d-block d-md-none"><i class="fas fa-pencil-alt"></i></span>
</a>
@endcan
