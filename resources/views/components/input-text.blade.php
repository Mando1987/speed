



<input type="{{ $type  }}" name="{{ $name }}" value="{{ $value ?? null }}" class="form-control @error($key ?? $name) is-invalid @enderror"
    placeholder="{{ $placeholder ?? '' }}" data="{{\str_replace('[' , '.' ,\str_replace(']' , '' ,$name))}}">
@error($key ?? $name)
<span class="error invalid-feedback">{{ $message }}</span>
@enderror
