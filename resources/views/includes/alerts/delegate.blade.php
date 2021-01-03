<div class="mt-3">
    <div class="bolder mb-2">
        {{$message ?? ''}}
    </div>
    <div class="d-flex justify-content-between">
        <a class="btn btn-success" href="{{ route('delegate.create') }}">@lang('site.alert_add_delegate') </a>
        <a class="btn btn-secondary" href="{{ route('delegate.index') }}"> @lang('site.alert_view_delegate') </a>
    </div>
</div>
