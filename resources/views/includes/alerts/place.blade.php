<div class="mt-3">
    <div class="bolder mb-2">
        {{$message ?? ''}}
    </div>
    <div class="d-flex justify-content-between">
        <a class="btn btn-success" href="{{ route('place.create') }}">@lang('site.alert_add_place') </a>
        <a class="btn btn-secondary" href="{{ route('place.index') }}"> @lang('site.alert_view_place') </a>
    </div>
</div>
