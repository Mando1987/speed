<select class="custom-select" name="{{ $name }}"
    id="customer_id">
        @foreach($customers as $customer)
           <option value="{{ $customer->id }}" @if($customer->id == $selected) selected @endif >{{ $customer->fullname }}</option>
        @endforeach
</select>