<select class="custom-select" name="{{ $name }}" {{$attributes}}>
        @foreach($cities as $city)
           <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
</select>
