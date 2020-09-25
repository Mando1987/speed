@extends('layouts.dashboard')
{{-- @extends('layouts.dataTable')

@section('button')
        <x-add-button route="order.create" />
@endsection
@if($orders->count())

@section('thead')
<tr>
    <th> # </th>
    @foreach (trans('datatable.order.customer') as $column =>$val)
       <th>{{trans('datatable.order.customer.' . $column)}}</th>
    @endforeach
    <th>@lang('site.actions')</th>
</tr>
@endsection

@section('tbody')
@foreach($orders as $index => $order)
<tr>
    <td class="sorting_1" tabindex="0">{{ $orders->firstItem()+$index }}</td>
    <td> {{ $order->reciver->fullname  }} </td>
    <td> {{ $order->getDate()}} </td>
    <td> {{ $order->reciver->city->name }} </td>
    <td> {{ $order->reciver->phone }} </td>
    <td> {{ $order->shipping->price  }}</td>
    <td> {{ $order->status }}</td>
    <td> {{ $order->shipping->order_num  }}</td>
    <td>
        <div class="btn-group btn-group-sm">
            <x-show-button   ability="admin_show"    route="order.show"    id="{{ $order->id }}" />
            <x-edit-button   ability="order_edit"    route="order.edit"    id="{{ $order->id }}" />
            <x-delete-button ability="order_destroy" route="order.destroy" id="{{ $order->id }}" />
        </div>
    </td>
</tr>
@endforeach

@endsection

@section('paginate')
{{  $orders->links() }}
@endsection

@else
@section('empty')
<x-empty-records-button-add route="order.create" />
@endsection
@endif --}}

@section('content')
{{-- <div class="card-header">
    <div class="input-group input-group-sm">
        <input type="text" class="form-control" placeholder="Search Mail">
        <div class="input-group-append">
          <div class="btn btn-primary">
            <i class="fas fa-search"></i>
          </div>
        </div>
      </div>
</div> --}}

    <div class="card bg-light">

    <div class="card-body pt-0">
        <table class="table table-sm text-nowrap">

            <tbody>
                <tr>
                    <td>@lang('datatable.order.customer.created_at')</td>
                    <td>{{ now() }}</td>
                </tr>
              <tr>
                <td>@lang('datatable.order.customer.reciver')</td>
                <td>{{ $order->reciver->fullname ?? 'ابراهيم السيد توفيق' }}</td>
              </tr>
              <tr>
                <td>@lang('datatable.order.customer.phone')</td>
                <td>{{ $order->reciver->phone ?? '43498349534'  }}</td>
              </tr>
              <tr>
                <td>@lang('datatable.order.customer.city')</td>
                <td>{{$order->reciver->city->name ?? 'cairo'}}</td>
              </tr>
              <tr>
                <td>@lang('datatable.order.customer.status')</td>
                <td>{{ $order->status ?? 'status' }}</td>
              </tr>
              <tr>
                  <td>@lang('datatable.order.customer.total_price')</td>
                  <td>{{$order->shipping->price ?? 500}}</td>
              </tr>
              <tr>
                  <td>@lang('datatable.order.customer.order_num')</td>
                  <td>{{ $order->shipping->order_num ?? 301855 }}</td>
              </tr>
            </tbody>
          </table>

    </div>
    <div class="card-footer text-center">
        <div class="btn-group btn-group-sm">
            <x-show-button   ability="admin_show"    route="order.show"    id="{{ $order->id ?? 1 }}" />
            <x-edit-button   ability="order_edit"    route="order.edit"    id="{{ $order->id ?? 1}}" />
            <x-delete-button ability="order_destroy" route="order.destroy" id="{{ $order->id ?? 1}}" />
        </div>
    </div>
    </div>
    <div class="card bg-light">

    <div class="card-body pt-0">
        <table class="table table-sm text-nowrap">

            <tbody>
                <tr>
                    <td>@lang('datatable.order.customer.created_at')</td>
                    <td>{{ now() }}</td>
                </tr>
              <tr>
                <td>@lang('datatable.order.customer.reciver')</td>
                <td>{{ $order->reciver->fullname ?? 'ابراهيم السيد توفيق' }}</td>
              </tr>
              <tr>
                <td>@lang('datatable.order.customer.phone')</td>
                <td>{{ $order->reciver->phone ?? '43498349534'  }}</td>
              </tr>
              <tr>
                <td>@lang('datatable.order.customer.city')</td>
                <td>{{$order->reciver->city->name ?? 'cairo'}}</td>
              </tr>
              <tr>
                <td>@lang('datatable.order.customer.status')</td>
                <td>{{ $order->status ?? 'status' }}</td>
              </tr>
              <tr>
                  <td>@lang('datatable.order.customer.total_price')</td>
                  <td>{{$order->shipping->price ?? 500}}</td>
              </tr>
              <tr>
                  <td>@lang('datatable.order.customer.order_num')</td>
                  <td>{{ $order->shipping->order_num ?? 301855 }}</td>
              </tr>
            </tbody>
          </table>

    </div>
    <div class="card-footer text-center">
        <div class="btn-group btn-group-sm">
            <x-show-button   ability="admin_show"    route="order.show"    id="{{ $order->id ?? 1 }}" />
            <x-edit-button   ability="order_edit"    route="order.edit"    id="{{ $order->id ?? 1}}" />
            <x-delete-button ability="order_destroy" route="order.destroy" id="{{ $order->id ?? 1}}" />
        </div>
    </div>
    </div>







  @endsection