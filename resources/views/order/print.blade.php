{{-- @extends('layouts.dashboard')
@section('content') --}}


<div class="wrapper">
  <!-- Main content -->
  <section class="p-1">
    <div class="container-fluid border border-dark">
      <div class="row mb-0">
        <div class="col-4 border-right border-dark p-1 mb-0">
          <table class="table table-sm table-bordered mb-0">
            <tbody>
              <tr>
                <td><strong>@lang('site.order_print_date')</strong></td>
                <td>{{ $order->date }}</td>
              </tr>
              <tr>
                <td><strong> @lang('site.order_print_num')</strong></td>
                <td>{{ $order->shipping->order_num }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-4 text-center border-right border-dark p-1 mb-0">
          <img src="{{asset('assets/dist/img/logo.png')}}" alt="SPEED" class="img-fluid print-logo-img">
        </div>
        <div class="col-4 p-1 mb-0">
          <table class="table table-sm table-bordered mb-0">
            <tbody>
              <tr>
                <td><strong>@lang('site.order_print_city')</strong></td>
                <td>{{ $order->reciver->city }}</td>
              </tr>
              <tr>
                <td><strong>@lang('site.order_print_governorate')</strong></td>
                <td>{{ $order->reciver->governorate }}</td>
              </tr>
            </tbody>
          </table>
        </div>

      </div><!-- /.row logo and date -->
    </div>
    <div class="container-fluid border-bottom border-left border-right border-dark mb-0">
      <div class="row">
        <div class="col-6 border-right border-dark p-1 mb-0">
          <div class="text-center font-weight-bold">@lang('site.order_print_employee')</div>
          <table class="table table-sm table-bordered mb-0">
            <tbody class="text-left">
              <tr>
                <td class="font-weight-bold">@lang('site.order_print_name')</td>
                <td>{{ $order->customer->fullname }}</td>
              </tr>
              <tr>
                <td class="font-weight-bold">@lang('site.order_print_phone')</td>
                <td>{{ $order->customer->phone }}</td>
              </tr>
              <tr>
                <td class="font-weight-bold">@lang('site.order_print_address')</td>
                <td>
                  <span>{{ $order->customer->address->house_number }}</span>
                  <span>{{ $order->customer->address->address }} - </span>
                  <span>@lang('site.order_print_door_num') {{ $order->customer->address->door_number }} - </span>
                  <span>@lang('site.order_print_shaka_number') {{ $order->customer->address->shaka_number }} - </span>
                  <span>{{ $order->customer->city }} - </span>
                  <span>{{ $order->customer->governorate }} </span>
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
        </div><!-- /.left customer -->
        <div class="col-6 p-1 mb-0">
          <div class="text-center font-weight-bold">@lang('site.order_print_reciver')</div>
          <table class="table table-sm table-bordered mb-0">
            <tbody class="text-left">
              <tr>
                <td class="font-weight-bold">@lang('site.order_print_name')</td>
                <td>{{ $order->reciver->fullname }}</td>
              </tr>
              <tr>
                <td class="font-weight-bold">@lang('site.order_print_phone')</td>
                <td>{{ $order->reciver->phone }}</td>
              </tr>
              <tr>
                <td class="font-weight-bold">@lang('site.order_print_address')</td>
                <td>
                  <span>{{ $order->reciver->address->house_number }}</span>
                  <span>{{ $order->reciver->address->address }} - </span>
                  <span>@lang('site.order_print_door_num') {{ $order->reciver->address->door_number }} - </span>
                  <span>@lang('site.order_print_shaka_number') {{ $order->reciver->address->shaka_number }} - </span>
                  <span>{{ $order->reciver->city }} - </span>
                  <span>{{ $order->reciver->governorate }} </span>
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
        </div><!-- /.left reciver -->

      </div>
    </div>
    <div class="container-fluid border-bottom border-left border-right border-dark">
      <div class="row">
        <div class="col-6 p-1 border-right border-dark">
          <table class="table table-sm table-bordered mb-0 mb-0">
            <tbody>
              <tr>
                <td class="font-weight-bold">@lang('site.order_print_open_charge')</td>
                <td>
                  <span>{{ $order->userCanOpenOrder }}</span>
                </td>
              </tr>
              <tr>
                <td class="font-weight-bold">@lang('site.order_print_charge_on')</td>
                <td>
                  <span>{{ $order->charge_on }}</span>
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
        </div><!-- /.left reciver -->
        <div class="col-6 p-1">
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
                </td>
              </tr>
            </tbody>
          </table>
        </div><!-- /.left reciver -->

      </div>
    </div>
    <div class="container-fluid">
      <div class="row text-center" style="font-size: 18px">
        <div class="col-12">
          <span>@lang('site.order_print_danger_msg')</span>
          <span class="d-block">@lang('site.order_print_contact_msg')</span>
        </div>
      </div>
    </div><!-- contact_msg-->
  </section>
  <!-- /.content -->

</div>
<!-- ./wrapper -->
<script>
 // window.addEventListener("load", window.print());
</script>


{{-- @endsection --}}