<select class="custom-select governorate_id" name="{{ $name }}" {{$attributes}}>

        @foreach($governorates as $governorate)
           <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
        @endforeach
</select>
