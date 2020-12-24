<select class="custom-select" name="{{ $name }}" id="customer_id">
        @foreach($customers as $customer)
           <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
        @endforeach
</select>
