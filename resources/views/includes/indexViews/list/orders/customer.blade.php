<tr>
    <td class="sorting_1" tabindex="0">{{ $orders->firstItem()+$index }}</td>
    <td class="text-muted"> {{ $order->reciver->fullname??'' }} </td>
    <td class="text-muted"> {{ $order->created_at->format('Y-m-d')}} </td>
    <td class="text-muted"> {{ $order->reciver->city->name }} </td>
    <td class="font-weight-bold"> {{ $order->reciver->phone ?? '' }} </td>
    <td class="font-weight-bold"> {{ $order->shipping->customer_price??''  }}</td>
    <td class="font-weight-bold">
        <span class="badge w-100 p-2 bg-{{ __('site.color_' . $order->status)}}">
            {{ $order->getStatus() ?? '' }}
        </span>
    </td>
    <td class="font-weight-bold text-muted"> {{ $order->shipping->order_num ??0 }}</td>
    <td>
        @include('includes.orders.index.customer_buttons')
    </td>
</tr>
