<tr>
    <td class="sorting_1" tabindex="0">{{ $orders->firstItem()+$index }}</td>
    <td> {{ $order->client->fullname}} </td>
    <td> {{ $order->client->city->name }} </td>
    <td> {{ $order->client->phone }} </td>
    <td class="font-weight-bold"> {{ $order->shipping->order_num ?? 0 }}</td>
    <td>
         @include('includes.orders.index.delegate_buttons')
    </td>
</tr>
