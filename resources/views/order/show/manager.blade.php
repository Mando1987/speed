@if($order)
<div class="card">
    <div class="card-header ui-sortable-handle">
        <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#customer" data-toggle="tab">
                        @lang('site.customer_show_title')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reciver" data-toggle="tab">
                        @lang('site.manager_reciver_title')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#order" data-toggle="tab">
                        @lang('site.order_show_title')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#shipping" data-toggle="tab">
                        @lang('site.order_show_shipping')
                    </a>
                </li>
            </ul>
        </div>

    </div><!-- /.card-header -->
    <div class="card-body p-0">
        <div class="tab-content p-0">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active" id="customer">
                <table class="table text-nowrap align-items-stretch table-bordered table-sm">
                    <tr>
                        <td>@lang('site.fullname')</td>
                        <td>{{ $order->customer->fullname }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.phone')</td>
                        <td>{{ $order->customer->phone }} {{$order->customer->other_phone ? ' - '.$order->customer->other_phone:false}} </td>
                    </tr>
                    <tr>
                        <td>@lang('site.governorate')</td>
                        <td>{{ $order->customer->governorate->name }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.city')</td>
                        <td>{{ $order->customer->city->name }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.address')</td>
                        <td>{{ $order->customer->address->address }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.special_marque')</td>
                          <td>  {{ $order->customer->address->special_marque }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.house_number')</td>
                        <td>{{ $order->customer->address->house_number }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.door_number')</td>
                        <td>{{ $order->customer->address->door_number }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.shaka_number')</td>
                        <td>{{ $order->customer->address->shaka_number }}</td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane" id="reciver">
                <table class="table text-nowrap align-items-stretch table-bordered table-sm">
                    <tr>
                        <td>@lang('site.fullname')</td>
                        <td>{{ $order->reciver->fullname }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.phone')</td>
                        <td>{{ $order->reciver->phone . ($order->reciver->other_phone?' - ' .$order->reciver->other_phone:false) }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.governorate')</td>
                        <td>{{ $order->reciver->governorate->name }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.city')</td>
                        <td>{{ $order->reciver->city->name }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.address')</td>
                        <td>{{ $order->reciver->address->address }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.special_marque')</td>
                          <td>  {{ $order->reciver->address->special_marque }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.house_number')</td>
                        <td>{{ $order->reciver->address->house_number }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.door_number')</td>
                        <td>{{ $order->reciver->address->door_number }}</td>
                    </tr>
                    <tr>
                        <td>@lang('site.shaka_number')</td>
                        <td>{{ $order->reciver->address->shaka_number }}</td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane" id="order">
                <table class="table text-nowrap align-items-stretch table-bordered table-sm">
                    <tr>
                        <td>@lang('site.order_status')</td>
                        <td>
                            <span class="badge p-2 bg-{{ __('site.color_' . $order->status)}}">
                                {{ $order->getStatus() ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('site.order_show_date')</td>
                        <td>
                            {{$order->created_at->format('Y-m-d')}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('site.order_info')</td>
                        <td>
                            {{$order->info}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('site.order_notes')</td>
                        <td>
                            {{$order->notes}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('site.order_user_can_open_order')</td>
                        <td>
                            {{$order->getOpenOrder()}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('site.order_serial')</td>
                        <td>
                            {{$order->shipping->order_num}}
                        </td>
                    </tr>

                </table>

            </div>
            <div class="tab-pane" id="shipping">
                <table class="table text-nowrap align-items-stretch table-bordered table-sm">
                    <tr>
                        <td>@lang('site.order_weight')</td>
                        <td dir="ltr">
                            {{$order->shipping->weight}}
                        </td>
                    </tr>
                    <tr dir="ltr">
                        <td>@lang('site.order_quantity')</td>
                        <td>
                            {{$order->shipping->quantity}}
                        </td>
                    </tr>
                    <tr dir="ltr">
                        <td>@lang('site.order_total_weight')</td>
                        <td>
                            {{$order->shipping->total_weight}}
                        </td>
                    </tr>
                    <tr dir="ltr">
                        <td>@lang('site.order_total_over_weight')</td>
                        <td>
                            {{$order->shipping->total_over_weight}}
                        </td>
                    </tr>
                    <tr dir="ltr">
                        <td>@lang('site.order_total_over_weight_price')</td>
                        <td>
                            {{$order->shipping->total_over_weight_price}}
                        </td>
                    </tr>
                    <tr dir="ltr">
                        <td>@lang('site.order_show_discount')</td>
                        <td>
                            {{$order->shipping->discount}}
                        </td>
                    </tr>
                    <tr dir="ltr">
                        <td>@lang('site.order_price')</td>
                        <td>
                            {{$order->shipping->price}}
                        </td>
                    </tr>
                    <tr dir="ltr">
                        <td>@lang('site.order_charge_price')</td>
                        <td>
                            {{$order->shipping->charge_price}}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('site.order_charge')</td>
                        <td>
                            {{__('site.order_charge_' . $order->shipping->charge_on)}}
                        </td>
                    </tr>
                    <tr dir="ltr">
                        <td>@lang('site.order_total_price')</td>
                        <td>
                            {{$order->shipping->final_price}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div><!-- /.card-body -->
</div>
@else
@include('includes.not_found_id')
@endif