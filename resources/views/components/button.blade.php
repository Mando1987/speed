@isset($disabled)
<a class="btn {{ $btnColor }} btn-sm disabled" href="#">
    <span class="d-none d-md-block">
        <i class="{{ $btnIcon }}"></i>
        {{ $text ?? ''}}
    </span>
    <span class="d-block d-md-none">
        <i class="{{ $btnIcon }}"></i>
    </span>
</a>
@else
<a class="btn {{ $btnColor }} btn-sm {{ $class ?? '' }}" href="{{ $route ?? '' }}">
    <span class="d-none d-md-block">
        <i class="{{ $btnIcon }}"></i>
         {{ $text ?? ''}}
    </span>
    <span class="d-block d-md-none">
        <i class="{{ $btnIcon }}"></i>
    </span>
</a>
@endisset
