<select class="custom-select" name="{{ $name }}"
    id="city_id">
        @foreach($cities as $city)
           <option value="{{ $city->id }}" @if($city->id == $selected) selected @endif >{{ $city->name }}</option>
        @endforeach
</select>