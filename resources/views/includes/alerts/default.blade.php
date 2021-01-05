<div class="mt-3">
    <div class="bolder mb-2">
        {{$message}}
    </div>
    <div class="d-flex justify-content-between">
        <a class="btn btn-success" href="{{ route($routeName.'.create') }}">@lang('site.alert_add_'.$routeName) </a>
        <a class="btn btn-secondary" href="{{ route($routeName.'.index') }}"> @lang('site.alert_view_'.$routeName) </a>
    </div>
</div>
