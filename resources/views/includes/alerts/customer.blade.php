<div class="mt-3">
    <div class="bolder mb-2">
        {{$message ?? ''}}
    </div>
    <div class="d-flex justify-content-between">
        <a class="btn btn-success" href="{{ route('customer.create') }}">@lang('site.alert_add_customer') </a>
        <a class="btn btn-secondary" href="{{ route('customer.index') }}"> @lang('site.alert_view_customer') </a>
    </div>
</div>
