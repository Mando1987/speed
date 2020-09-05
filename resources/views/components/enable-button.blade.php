<div class="custom-control custom-switch">

    <input type="checkbox" class="custom-control-input changeActive" id="customSwitch{{ $id }}"
        @if($isActive == 1) checked @endif dataId="{{ $id }}"
    dataUrl="{{ route($route , $id) }}">

    <label class="custom-control-label" for="customSwitch{{ $id }}">
        <span class="changeActiveSpan{{ $id }}">@if($isActive == 1) @lang('site.active') @else @lang('site.notactive') @endif</span>
    </label>

</div