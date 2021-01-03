@if($order)
<!-- start of card -->
<div class="card card-purple card-outline p-0 m-0">
  <!-- start of card-body -->
  <div class="card-body p-0">
      <section class="invoice p-1">
        <!-- contact_msg-->
        <div class="border border-dark">
          <div class="row mb-0">
            <div class="col-sm-4 invoice-col border-right border-dark p-1 mb-0">
              <div class="col-12 table-responsive">
                <table class="table table-sm table-bordered mb-0">
                  <tbody>
                    <tr>
                      <td><strong>@lang('site.order_print_date')</strong></td>
                      <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                      <td><strong> @lang('site.order_print_num')</strong></td>
                      <td>{{ $order->shipping->order_num }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-sm-4 invoice-col text-center border-right border-dark p-1 mb-0">
              <img src="{{asset('assets/dist/img/logo.png')}}" alt="SPEED" class="img-fluid print-logo-img">
            </div>
            <div class="col-sm-4 invoice-col p-1 mb-0">
              <div class="col-12 table-responsive">
                <table class="table table-sm table-bordered mb-0">
                  <tbody>
                    <tr>
                      <td><strong>@lang('site.order_print_city')</strong></td>
                      <td>{{ $order->reciver->city->name }}</td>
                    </tr>
                    <tr>
                      <td><strong>@lang('site.order_print_governorate')</strong></td>
                      <td>{{ $order->reciver->governorate->name }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- /.row logo and date -->
        </div>
        <!-- contact_msg-->
        <!-- contact_msg-->
        <div class="container-fluid border-bottom border-left border-right border-dark mb-0">
          <div class="row">
            <div class="col-6 border-right border-dark p-1 mb-0">
              <div class="text-center font-weight-bold">@lang('site.order_print_employee')</div>
              <div class="col-12 table-responsive">
                <table class="table table-sm table-bordered mb-0">
                  <tbody class="text-left">
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_name')</td>
                      <td>{{ $order->customer->fullname }}</td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_phone')</td>
                      <td>
                        {{ $order->customer->phone . ($order->customer->phone ? ' - ' . $order->customer->phone:false) }}
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_address')</td>
                      <td>
                        <span>{{ $order->customer->address->house_number }}</span>
                        <span>{{ $order->customer->address->address }} - </span>
                        <span>@lang('site.order_print_door_num') {{ $order->customer->address->door_number }} - </span>
                        <span>@lang('site.order_print_shaka_number') {{ $order->customer->address->shaka_number }} -
                        </span>
                        <span>{{ $order->customer->city->name }} - </span>
                        <span>{{ $order->customer->governorate->name }} </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_special_marque')</td>
                      <td>
                        {{ $order->customer->address->special_marque }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div><!-- /.left customer -->
            <div class="col-6 p-1 mb-0">
              <div class="text-center font-weight-bold">@lang('site.order_print_reciver')</div>
              <div class="col-12 table-responsive">
                <table class="table table-sm table-bordered mb-0">
                  <tbody class="text-left">
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_name')</td>
                      <td>{{ $order->reciver->fullname }}</td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_phone')</td>
                      <td>{{ $order->reciver->phone. ($order->reciver->phone ? ' - ' . $order->reciver->phone:false) }}
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_address')</td>
                      <td>
                        <span>{{ $order->reciver->address->house_number }}</span>
                        <span>{{ $order->reciver->address->address }} - </span>
                        <span>@lang('site.order_print_door_num') {{ $order->reciver->address->door_number }} - </span>
                        <span>@lang('site.order_print_shaka_number') {{ $order->reciver->address->shaka_number }} -
                        </span>
                        <span>{{ $order->reciver->city->name }} - </span>
                        <span>{{ $order->reciver->governorate->name }} </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_special_marque')</td>
                      <td>
                        {{ $order->reciver->address->special_marque }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div><!-- /.left reciver -->
          </div>
        </div>
        <!-- contact_msg-->
        <!-- contact_msg-->
        <div class="container-fluid border-bottom border-left border-right border-dark">
          <div class="row">
            <div class="col-6 p-1 border-right border-dark">
              <div class="col-12 table-responsive">
                <table class="table table-sm table-bordered mb-0 mb-0">
                  <tbody>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_open_charge')</td>
                      <td>
                        <span>{{ $order->getUserCanOpenOrder() }}</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_charge_on')</td>
                      <td>
                        <span>{{ $order->shipping->getChargeOn() }}</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_notes')</td>
                      <td>
                        <span class="d-block">{{ $order->notes }}</span>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div><!-- /.left reciver -->
            <div class="col-6 p-1">
              <div class="col-12 table-responsive">
                <table class="table table-sm table-bordered mb-0">
                  <tbody>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_info')</td>
                      <td>
                        <span>{{ $order->info }}</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">@lang('site.order_print_order_weight')</td>
                      <td>
                        <span>{{ $order->shipping->total_weight }} @lang('site.order_weight_kg')</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="font-weight-bold">@lang('site.order_print_price')</span>
                      </td>
                      <td>
                        <span class="font-weight-bold text-center"
                          style="font-size: 19px">{{ $order->shipping->total_price }}</span>
                        <span>@lang('site.order_print_price_contain_charge_price')</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div><!-- /.left reciver -->

          </div>
        </div>
        <!-- contact_msg-->
        <!-- contact_msg-->
        <div class="container-fluid">
          <div class="row text-center" style="font-size: 18px">
            <div class="col-12">
              <span>@lang('site.order_print_danger_msg')</span>
              <span class="d-block">@lang('site.order_print_contact_msg')</span>
            </div>
          </div>
        </div>
        <!-- contact_msg-->
      </section>
  </div>
  <!-- end of card-body -->
  <div class="card-footer hide-in-print">
    <div class="float-right">
      <button class="btn btn-outline-secondary mr-1" onclick="Swal.close()">@lang('site.close')</button>
      <button class="btn btn-success" onclick="Swal.close();window.print()">@lang('site.print')</button>
    </div>
  </div>
</div>
<!-- end of card -->
@else
@include('includes.not_found_id')
@endif
