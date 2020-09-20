<input type="{{ $type  }}" name="{{ $name }}" value="{{ $value }}" class="form-control @error($key) is-invalid @enderror"
    placeholder="{{ $placeholder ?? '' }}">
@error($key)
<span class="error invalid-feedback">{{ $message }}</span>
@enderror
