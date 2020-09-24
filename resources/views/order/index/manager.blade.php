@extends('layouts.dashboard')
@extends('layouts.dataTable')

@section('button')
        <x-add-button route="order.create" />
@endsection
@if($orders->count())

@section('thead')
<tr>
    <th> # </th>
    @foreach (trans('datatable.order') as $column =>$val)
       <th>{{trans('datatable.order.' . $column)}}</th>
    @endforeach
    <th>@lang('site.actions')</th>
</tr>
@endsection

@section('tbody')
@foreach($orders as $index => $order)
<tr>
    <td class="sorting_1" tabindex="0">{{ $orders->firstItem()+$index }}</td>
    <td> {{ $order->sender->fullname ?? $order->customer->admin->fullname }} </td>
    <td> {{ $order->getDate()}} </td>
    <td> {{ $order->sender->city->name ?? $order->customer->city->name}} </td>
    <td> {{ $order->shipping->total_price  }}</td>
    <td> {{ $order->status }}</td>
    <td> -- </td>
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
@endif
