{{-- @extends('layouts.dashboard') --}}

{{-- @section('content') --}}


<div class="wrapper">
  <!-- Main content -->
  <section class="invoice p-1">
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
          <div class="user-block m-auto">
            <img src="{{asset('assets/dist/img/logo.png')}}" alt="SPEED" class="img-circle img-fluid float-right">
            <span class="username float-right">
              <div>@lang('site.order_print_website_name_en')</div>
              <div>@lang('site.order_print_website_name')</div>
            </span>

          </div>

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
                  <span>{{ $order->customer->city }} - </span>
                  <span>@lang('site.order_print_door_num') {{ $order->customer->address->door_number }} - </span>
                  <span>@lang('site.order_print_shaka_number') {{ $order->customer->address->shaka_number }} - </span>
                  <span>{{ $order->customer->governorate }} </span>
                  <span class="d-block">@lang('site.order_print_shaka_number')
                    {{ $order->customer->address->special_marque }}</span>
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
                  <span>{{ $order->reciver->city }} - </span>
                  <span>@lang('site.order_print_door_num') {{ $order->reciver->address->door_number }} - </span>
                  <span>@lang('site.order_print_shaka_number') {{ $order->reciver->address->shaka_number }} - </span>
                  <span>{{ $order->reciver->governorate }} </span>
                  <span class="d-block">@lang('site.order_print_shaka_number')
                    {{ $order->reciver->address->special_marque }}</span>

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
                <td class="font-weight-bold">@lang('site.order_print_notes')</td>
                <td>
                  <span>{{ $order->userCanOpenOrder }}</span>
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
            </tbody>
          </table>
        </div><!-- /.left reciver -->

      </div>
    </div>
    <div class="container-fluid border-bottom border-left border-right border-dark">

      <div class="row">
        <div class="col-3 p-1 border-right border-dark">

          <table class="table-sm w-100 h-100 m-auto">
            <tbody>
              <tr>
                <td>
                  <span class="font-weight-bold mr-3">@lang('site.order_print_price')</span>
                  <span
                    class="font-weight-bold border border-dark text-center px-2" style="font-size: 19px">{{ $order->shipping->total_price }}</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-5 p-1 border-right border-dark">
          <table class="table-sm w-100 h-100 m-auto">
            <tbody>
              <tr>
                <td>
                  <span class="font-weight-bold mr-1"> @lang('site.order_print_finished')</span>
                <span class="border border-dark text-center px-2" style="font-size: 23px">{{ $order->get_price_viza }}</span>
                </td>
                <td>
                  <span class="font-weight-bold mr-1"> @lang('site.order_print_get_price')</span>
                <span class="border border-dark text-center px-2" style="font-size: 23px">{{ $order->get_price }}</span>
                </td>

                <td>
                  <span class="font-weight-bold mr-1"> @lang('site.order_print_other')</span>
                  <span class="border border-dark text-center px-2" style="font-size: 23px">❌</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-4 p-1">
          <div class="text-center">
            <table class="table-sm w-100">
              <tbody>
                <tr class="text-center font-weight-bold">
                  <td colspan="4">@lang('site.order_print_charge_on')</td>
                </tr>
                <tr>
                  <td>
                    <span class="border border-dark px-2 mr-1">@lang('site.order_print_charge_on_sender')</span>
                  <span style="font-size: 23px">{{ $order->charge_on_customer }}</span>
                  </td>
                  <td>
                    <span class="border border-dark px-2 mr-1">@lang('site.order_print_charge_on_reciver')</span>
                  <span style="font-size: 23px"> {{ $order->charge_on_reciver }}</span>
                  </td>

                </tr>
              </tbody>
            </table>
          </div>
        </div>


      </div>
    </div>
    <div class="container-fluid">
      <div class="row text-center" style="font-size: 18px">
        <div class="col-12">
          <span>@lang('site.order_print_danger_msg')</span>
          <span class="d-block">@lang('site.order_print_contact_msg')</span>
        </div>
      </div>
    </div>


  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>


{{-- @endsection --}}