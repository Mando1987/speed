<tr>
    <td class="sorting_1" tabindex="0">{{ $orders->firstItem()+$index }}</td>
    <td> {{ $order->customer->fullname}} </td>
    <td> {{ $order->created_at->format('Y-m-d')}} </td>
    <td> {{ $order->customer->city->name }} </td>
    <td> {{ $order->customer->phone }} </td>
    <td> {{ $order->reciver->fullname }} </td>
    <td class="font-weight-bold"> {{ $order->shipping->total_price??''  }}</td>
    <td>
        <span class="badge w-100 p-2 bg-{{ __('site.color_' . $order->status)}}">
            {{ $order->getStatus() ?? '' }}
        </span>
    </td>
    <td class="font-weight-bold"> {{ $order->shipping->order_num ?? 0 }}</td>
    <td>
         @include('includes.orders.index.manager_buttons')
    </td>
</tr>
