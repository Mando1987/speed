@extends('layouts.dashboard')
@extends('layouts.dataTable')

@section('button')
<div class="row">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <x-add-button route="price.create" />
            </div>
            <div style=width:20px></div>
            <div class="input-group-prepend">
                <span class="badge bg-secondary pt-3">
                    @lang('site.governorate')
                </span>
            </div>
            <form role="form" id="getCitiesPrice" action="{{ route('price.index') }}" method="GET" >

                <select class="custom-select" name="governorate_id" id="getCitiesPriceSelect">
                    @foreach($governorates as $governorate)
                    <option value="{{ $governorate->id }}" @if($governorate->id == $selectedGovId) selected @endif>{{ $governorate->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

</div>
@endsection
@if($governorateCitiesPrice->count())

@section('thead')
<tr>
    <th> # </th>
    <th> @lang('site.city')</th>
    <th> @lang('site.price_send_weight')</th>
    <th> @lang('site.price_send_price')</th>
    <th> @lang('site.price_weight_addtion')</th>
    <th> @lang('site.price_price_addtion')</th>
    <th> @lang('site.actions') </th>
</tr>
@endsection

@section('tbody')
@foreach($governorateCitiesPrice as $index => $city)
<tr>
    <td class="sorting_1" tabindex="0">{{ $governorateCitiesPrice->firstItem()+$index }}</td>
    <td> {{ $city->name }} </td>
    <td> {{ $city->placePrices->send_weight    }} @lang('site.price_weight')</td>
    <td> {{ $city->placePrices->send_price     }} @lang('site.price_bound') </td>
    <td> {{ $city->placePrices->weight_addtion }} @lang('site.price_weight') </td>
    <td> {{ $city->placePrices->price_addtion  }} @lang('site.price_bound') </td>
    <td>
        <div class="btn-group btn-group-sm">
            @if($city->placePrices->send_weight > 0)

            <x-edit-button ability="price_edit" route="price.edit" id="{{ $city->id }}" />
            <x-delete-button ability="price_destroy" route="price.destroy" id="{{ $city->placePrices->id }}" />
            @else
            <x-price_edit-button ability="price_edit" route="price.edit" id="{{ $city->id }}" />

            @endif

        </div>
    </td>
</tr>
@endforeach

@endsection

@section('paginate')
{{  $governorateCitiesPrice->appends(['governorate_id' =>$selectedGovId ])->links() }}
@endsection

@else
@section('empty')
<x-empty-records-button-add route="price.create" />
@endsection
@endif
