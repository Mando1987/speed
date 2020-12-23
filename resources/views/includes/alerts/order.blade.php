<div class="mt-3">
    <div class="bolder mb-2">
        {{$message ?? ''}}
    </div>
    <div class="d-flex justify-content-between">
        <a class="btn btn-success" href="{{ route('order.create') }}">@lang('site.alert_add_order') </a>
        <a class="btn btn-secondary" href="{{ route('order.store') }}"> @lang('site.alert_view_order') </a>
    </div>
</div>
