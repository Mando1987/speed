



<input type="{{ $type ?? 'text'  }}" name="{{ $name }}" value="{{ $value ?? old($name) }}" class="form-control @error($key) is-invalid @enderror"
    place_holder="{{ $placeholder ?? '' }}" data="{{\str_replace('[' , '.' ,\str_replace(']' , '' ,$name))}}">
@error($key)
<span class="error invalid-feedback">{{ $message }}</span>
@enderror
