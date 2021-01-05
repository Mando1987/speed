<tr>
    <td class="sorting_1" tabindex="0">{{ $prices->firstItem()+$index }}</td>
    <td> {{ $price->city->name }} </td>
    <td> {{ $price->send_weight    }} @lang('site.price_weight')</td>
    <td> {{ $price->send_price     }} @lang('site.price_bound') </td>
    <td> {{ $price->weight_addtion }} @lang('site.price_weight') </td>
    <td> {{ $price->price_addtion  }} @lang('site.price_bound') </td>
    <td>
        <x-button :route="route('price.edit', $price->id)" type="edit" />
        <x-button :route="route('price.destroy', $price->id)" type="delete" class="showSingleModel" />
    </td>
</tr>
