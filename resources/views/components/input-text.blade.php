



<input type="{{ $type  }}" name="{{ $name }}" value="{{ $value ?? null }}" class="form-control @error($key ?? $name) is-invalid @enderror"
    placeholder="{{ $placeholder ?? '' }}">
@error($key ?? $name)
<span class="error invalid-feedback">{{ $message }}</span>
@enderror
