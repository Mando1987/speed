<select class="custom-select" name="{{ $name }}"
    id="reciver_id">
    @if($recivers->count())
        @foreach($recivers as $reciver)
           <option value="{{ $reciver->id }}" @if($reciver->id == $selected) selected @endif>{{ $reciver->fullname }}</option>
        @endforeach
    @else
    <option value="">@lang('site.no_record')</option>
    @endif
</select>