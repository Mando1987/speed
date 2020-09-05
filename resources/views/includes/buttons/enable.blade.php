

<div class="custom-control custom-switch">

    <input type="checkbox" class="custom-control-input changeActive" 
        id="customSwitch{{ $id }}" @if($active == 1) checked @endif dataId="{{ $id }}" dataUrl="{{ $url }}">

    <label class="custom-control-label"
        for="customSwitch{{ $id }}">
        <span class="changeActiveSpan{{ $id }}">{{ $getActive }}</span>
    </label>

</div>