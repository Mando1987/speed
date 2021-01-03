<div class="col-12 col-sm-6 col-md-4  d-flex align-items-stretch">
    <div class="card bg-light w-100 card-outline card-{{ __('site.color_' . $order->status) }}">
        <div class="card-body pt-0 mb-0 pb-1 p-0">
            <table class="table text-nowrap align-items-stretch table-sm">
                <tbody>
                    <tr>
                        <td class="border-top-0">@lang('datatable.order.customer.created_at')</td>
                        <td class="border-top-0 font-weight-bold text-muted">
                            {{ $order->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.customer.reciver')</td>
                        <td class="font-weight-bold text-muted">
                            {{ $order->reciver->fullname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.customer.phone')</td>
                        <td class="font-weight-bold text-muted">
                            {{ $order->reciver->phone ?? ''  }}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.customer.city')</td>
                        <td class="font-weight-bold text-muted">
                            {{$order->reciver->city->name ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.customer.status')</td>
                        <td class="font-weight-bold text-muted">
                            <span class="badge p-2 bg-{{ __('site.color_' . $order->status)}}">
                                {{ $order->getStatus() ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.customer.total_price')</td>
                        <td class="font-weight-bold text-muted">
                            {{$order->shipping->customer_price ?? 0}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.customer.order_num')</td>
                        <td class="font-weight-bold text-muted">
                            {{ $order->shipping->order_num ?? 0 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-3 mb-0">
                @include('includes.orders.index.customer_buttons')
            </div>
        </div>
    </div><!-- end of card-->
</div>
