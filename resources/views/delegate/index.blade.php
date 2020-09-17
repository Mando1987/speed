@extends('layouts.dashboard')
@extends('layouts.dataTable')

@section('button')
        <x-add-button route="delegate.create" />
@endsection
@if($delegates->count())

@section('thead')
<tr>
    <th> # </th>
    @foreach (trans('datatable.delegate') as $column =>$val)
       <th>{{trans('datatable.delegate.' . $column)}}</th>
    @endforeach
    <th>@lang('site.actions')</th>
</tr>
@endsection

@section('tbody')
@foreach($delegates as $index => $delegate)
<tr>
    <td class="sorting_1" tabindex="0">{{ $delegates->firstItem()+$index }}</td>
    <td> {{ $delegate->fullname }} </td>
    <td> {{ $delegate->qualification }}</td>
    <td> {{ $delegate->phone }}</td>
    <td> {{ $delegate->delegateDrive->type }}</td>
    <td> {{ $delegate->delegateDrive->color }}</td>
    <td> {{ $delegate->delegateDrive->plate_number }}</td>
    <td class="text-left"><x-enable-button ability="delegate_edit" route="delegate.changeActive"  isActive="{{$delegate->active }}"   id="{{ $delegate->id }}" /></td>
    <td>
        <div class="btn-group btn-group-sm">
            <x-show-button   ability="delegate_show"    route="delegate.show"    id="{{ $delegate->id }}" />
            <x-edit-button   ability="delegate_edit"    route="delegate.edit"    id="{{ $delegate->id }}" />
            <x-delete-button ability="delegate_destroy" route="delegate.destroy" id="{{ $delegate->id }}" />
        </div>
    </td>
</tr>
@endforeach

@endsection

@section('paginate')
{{  $delegates->links() }}
@endsection

@else
@section('empty')
<x-empty-records-button-add route="delegate.create" />
@endsection
@endif
