@can($ability)
<button class="btn btn-danger btn-sm" onclick="deletedMethod({{ $id }})">
    <span class="d-none d-md-block">
        <i class="far fa-trash-alt"></i>
        @lang('site.delete')
    </span>
    <span class="d-block d-md-none">
        <i class="far fa-trash-alt"></i>
    </span>
</button>

<form id="deletedForm{{ $id }}" action="{{ route($route, $id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
@else
<button class="btn btn-danger btn-sm disabled">
    <i class="far fa-trash-alt"></i>
    @lang('site.delete')
</button>
@endcan
