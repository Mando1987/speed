@extends('layouts.dashboard')

@section('content')
<div class="card card-solid">
  <div class="card-header p-1 border-bottom-0">
    <form class="w-100" id="changeStatus" action="{{ route('order.index') }}" method="GET">
      <div class="row d-flex align-items-stretch">
        <div class="col-12 col-sm-5 col-md-5  d-flex align-items-stretch mb-1">
          <select class="custom-select custom-select-sm" id="orderStatus" name="status">
            <option value="all">@lang('site.dashboard_all_orders')</option>
            @foreach (config('orderStatus') as $orderStatus)
            <option value="{{ $orderStatus }}" "@if ($orderStatus == $status) selected @endif">
              @lang('site.order_status_'
              . $orderStatus)</option>
            @endforeach
          </select>
        </div>
        <div class="col-8 col-sm-5 col-md-5">
          <div class="input-group input-group-sm">
            <input type="text" name="search" value="" placeholder="@lang('site.search_placeholder')"
              class="form-control">
            <span class="input-group-append">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
              </button>
            </span>
          </div>
        </div>
        <div class="col-4 col-sm-2 col-md-2">

          <div class="float-right">
            <button type="button" class="btn btn-sm btn-info show-view-setting">
              <i class="fas fa-wrench"></i>
            </button>
          </div>

        </div>
      </div>
    </form>
  </div>
  <!--card-header-->
  @if($orders->count())
  <div class="card-body p-1">
    @if($view =='grid')
    <div class="row d-flex align-items-stretch">
      @foreach($orders as $index => $order)
      <div class="col-12 col-sm-6 col-md-4  d-flex align-items-stretch">
        <div class="card bg-light w-100 card-outline card-{{ __('site.color_' . $order->status) }}">
          <div class="card-body pt-0 mb-0 pb-1 p-0">
            <table class="table text-nowrap align-items-stretch table-sm">
              <tbody>
                <tr>
                  <td class="border-top-0">@lang('datatable.order.manager.created_at')</td>
                  <td class="border-top-0">
                    <strong>
                      {{ $order->created_at->format('Y-m-d') }}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.order.manager.customer')</td>
                  <td>
                    <strong>
                      {{ $order->customer->fullname }}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.order.manager.phone')</td>
                  <td>
                    <strong>
                      {{ $order->customer->phone }}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.order.manager.city')</td>
                  <td>
                    <strong>
                      {{ $order->customer->city->name ?? ''}}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.order.manager.reciver')</td>
                  <td>
                    <strong>
                      {{ $order->reciver->fullname ?? ''}}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.order.manager.status')</td>
                  <td>
                    <span class="badge p-2 bg-{{ __('site.color_' . $order->status)}}">
                      {{ $order->getStatus() ?? '' }}
                    </span>

                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.order.manager.total_price')</td>
                  <td>
                    <strong>
                      {{$order->shipping->total_price ?? 0}}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.order.manager.order_num')</td>
                  <td>
                    <strong>
                      {{ $order->shipping->order_num ?? 0 }}
                    </strong>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="text-center mt-3 mb-0">
              <div class="btn-group btn-group-sm">
                <x-show-button ability="admin_show" route="order.show" id="{{ $order->id  }}" />
                @if($order->status == 'under_review ' || $order->status == 'under_preparation')
                <a class="btn btn-info btn-sm mr-2" href="{{ route('order.edit' , $order->id) }}">
                  <span class="d-none d-md-block">
                    <i class="fas fa-pencil-alt"></i>
                    @lang('site.edit')
                  </span>
                  <span class="d-block d-md-none"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <button class="btn btn-danger btn-sm" onclick="deletedMethod({{ $order->id }})">
                  <span class="d-none d-md-block">
                    <i class="far fa-trash-alt"></i>
                    @lang('site.delete')
                  </span>
                  <span class="d-block d-md-none">
                    <i class="far fa-trash-alt"></i>
                  </span>
                </button>
                <form id="deletedForm{{ $order->id }}" action="{{ route('order.destroy', $order->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                </form>
                @else
                <a class="btn btn-info btn-sm mr-2 disabled" href="#">
                  <span class="d-none d-md-block">
                    <i class="fas fa-pencil-alt"></i>
                    @lang('site.edit')
                  </span>
                  <span class="d-block d-md-none"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <button class="btn btn-danger btn-sm disabled">
                  <span class="d-none d-md-block">
                    <i class="far fa-trash-alt"></i>
                    @lang('site.delete')
                  </span>
                  <span class="d-block d-md-none">
                    <i class="far fa-trash-alt"></i>
                  </span>
                </button>
                @endif
                <a href="{{ route('order.print' ,['orderId' =>$order->id]) }}" class="print btn btn-default ml-1">
                  <i class="fas fa-print"></i>
                  @lang('site.print')
              </a>
              </div>
            </div>
          </div>
        </div><!-- end of card-->
      </div>
      @endforeach
    </div>
    @else
    <div class="table-responsive p-0">
      <table class="table table-head-fixed table-bordered text-nowrap text-center table-sm">
        <thead>
          <tr>
            <th> # </th>
            @foreach (trans('datatable.order.manager') as $column =>$val)
            <th>{{trans('datatable.order.manager.' . $column)}}</th>
            @endforeach
            <th>@lang('site.actions')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $index => $order)
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
            <td class="font-weight-bold"> {{ $order->shipping->order_num ??0 }}</td>
            <td>
              @include('includes.orders.action_buttons')
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <nav aria-label="Contacts Page Navigation">
      <ul class="pagination justify-content-center m-0">
        {{ $orders->appends(['view' => $view ,'status'=>$status??'all' , 'search'=> $search])->links() }}
      </ul>
    </nav>
  </div>
  <!-- /.card-footer -->
  @else
  <div class="m-3">
    <x-empty-records-button-add route="order.create" />
  </div>
  @endif

  <div class="modal fade" id="option-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div id="view_setting">
            <form action="{{ route('order.index') }}" method="GET">
            <div class="callout callout-info p-1">
              <h4>
                <i class="fas fa-eye"></i>
                @lang('site.view_setting')
              </h4>
            </div>
            <div class="row">
              <div class="col-3">
                <span class="font-weight-bold">@lang('site.option_view_style')</span>
              </div>
              <div class="col-9">
                <div class="form-group clearfix">
                  <div class="custom-control custom-radio d-inline">
                    <input class="custom-control-input" type="radio" id="view1" name="view" value="list" @if($view =='list') checked="" @endif>
                    <label for="view1" class="custom-control-label">
                      <i class="fas fa-bars"></i>
                    </label>
                  </div>
                  <div class="custom-control custom-radio d-inline ml-3">
                    <input class="custom-control-input" type="radio" id="view2" name="view" @if($view =='grid') checked="" @endif  value="grid">
                    <label for="view2" class="custom-control-label">
                      <i class="fas fa-th"></i>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!--end of row-->
            <div class="row">
              <div class="col-3">
                <span class="font-weight-bold">{{__('site.show_records_number')}}</span>
              </div>
              <div class="col-9">
                <div class="form-group row">
                  <select class="custom-select custom-select-sm font-weight-bold" name="paginate">
                    @foreach(range(5,50,5) as $number)
                    <option class="font-weight-bold" value="{{ $number }}" @if($number==$orders->perPage()) selected
                      @endif>{{ $number }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <!--end of row-->
            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-success btn-sm">@lang('site.save')</button>
              </div>
            </div>
          </form><!-- end of form -->
          </div> <!-- end of view_setting-->
        </div><!-- end of card-body-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
@endsection