<div class="mt-3">
    <div class="bolder mb-2">
        @lang('site.failed')
    </div>
    <div class="d-flex justify-content-center">
        <a class="btn btn-secondary" href="{{ route($routeName , $args) }}">@lang('site.retry') </a>
    </div>
</div>
