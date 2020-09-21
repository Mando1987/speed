


<div>
<input type="{{ $type  }}" name="{{ $name }}" value="{{ $value ?? null }}" class="form-control @error({{$mando}}) is-invalid @enderror"
    placeholder="{{ $placeholder ?? '' }}">
@error({{$mando}})
<span class="error invalid-feedback">{{ $message }}</span>
@enderror

</div>
