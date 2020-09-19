<select class="custom-select" name="{{ $name }}"
    id="governorate_id">
        @foreach($governorates as $governorate)
           <option value="{{ $governorate->id }}" @if($governorate->id == $selected) selected @endif >{{ $governorate->name }}</option>
        @endforeach
</select>
