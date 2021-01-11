<div class="col-12 col-sm-6 col-md-4  d-flex align-items-stretch">
    <div class="card bg-light w-100 card-outline card-{{ __('site.color_' . $order->status) }}">
        <div class="card-body pt-0 mb-0 pb-1 p-0">
            <table class="table text-nowrap align-items-stretch table-sm">
                <tbody>
                    <tr>
                        <td class="border-top-0">@lang('datatable.order.manager.created_at')</td>
                        <td class="border-top-0 font-weight-bold text-muted">
                            {{ $order->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.manager.customer')</td>
                        <td class="font-weight-bold text-muted">
                            {{ $order->customer->fullname }}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.manager.phone')</td>
                        <td class="font-weight-bold text-muted">
                            {{ $order->customer->phone }}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.manager.city')</td>
                        <td class="font-weight-bold text-muted">
                            {{ $order->customer->city->name ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.manager.reciver')</td>
                        <td class="font-weight-bold text-muted">
                            {{ $order->reciver->fullname ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.manager.status')</td>
                        <td class="font-weight-bold text-muted">
                            <span class="badge p-2 bg-{{ __('site.color_' . $order->status)}}">
                                {{ $order->getStatus() ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.manager.total_price')</td>
                        <td class="font-weight-bold text-muted">
                            {{$order->shipping->total_price ?? 0}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('datatable.order.manager.order_num')</td>
                        <td class="font-weight-bold text-muted">
                            {{ $order->shipping->order_num ?? 0 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-3 mb-0">
                @include('includes.orders.index.manager_buttons')
            </div>

        </div>
    </div><!-- end of card-->
</div>
