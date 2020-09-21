



<input type="{{ $type  }}" name="{{ $name }}" value="{{ $value ?? null }}" class="form-control @error($key) is-invalid @enderror"
    placeholder="{{ $placeholder ?? '' }}">
@error($key)
<span class="error invalid-feedback">{{ $message }}</span>
@enderror
