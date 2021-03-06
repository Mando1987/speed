@extends('layouts/dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-purple card-outline">
                <form id="FormSubmit" action="{{ route('order.update', $userData['order']->id) }}" method="POST">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="order-info">
                            <div class="row">
                                <div class="col-md">
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_type')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" name="order[type]">
                                                    <option value="next_day_delivery">
                                                        @lang('site.order_next_day_delivery')</option>
                                                    <option value="governorates_delivery">
                                                        @lang('site.order_governorates_delivery')</option>
                                                    <option value="international_shipping">
                                                        @lang('site.order_international_shipping')</option>
                                                    <option value="packaging_service">
                                                        @lang('site.order_packaging_service')</option>
                                                    <option value="correspondents_service">
                                                        @lang('site.order_correspondents_service')</option>
                                                    <option value="send_transmitters_service">
                                                        @lang('site.order_send_transmitters_service')
                                                    </option>
                                                    <option value="document_delivery_service">
                                                        @lang('site.order_document_delivery_service')
                                                    </option>
                                                    <option value="same_day_delivery">
                                                        @lang('site.order_same_day_delivery')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @if($adminIsManager)
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_status')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" name="order[status]">
                                                    <option value="under_preparation">
                                                        @lang('site.order_status_under_preparation') </option>
                                                    <option value="under_review">
                                                        @lang('site.order_status_under_review')
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_weight')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[weight]"
                                                    value="{{old('shipping.weight')}}"
                                                    class="form-control  @error('shipping.weight') is-invalid @enderror"
                                                    id="order_weight"
                                                    placeholder="@lang('site.order_weight_placeholder')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_quantity')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[quantity]"
                                                    value="{{old('shipping.quantity')}}"
                                                    class="form-control   @error('shipping.quantity') is-invalid @enderror"
                                                    id="order_quantity"
                                                    placeholder="@lang('site.order_quantity_placeholder')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_price')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[price]"
                                                    value="{{old('shipping.price')}}"
                                                    class="form-control  @error('shipping.price') is-invalid @enderror"
                                                    id="order_price"
                                                    placeholder="@lang('site.order_price_placeholder')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_info')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea name="order[info]"
                                                    class="form-control @error('order.info') is-invalid @enderror"
                                                    id="order_info" rows="1"
                                                    placeholder="@lang('site.order_info_placeholder')">{{old('order.info')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_notes')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea name="order[notes]"
                                                    class="form-control  @error('order.notes') is-invalid @enderror"
                                                    id="order_notes" rows="1"
                                                    placeholder="@lang('site.order_notes_placeholder')">{{old('order.order.notes')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_user_can_open_order')
                                                </span>
                                            </label>
                                            <div class="col-sm-6">
                                                <select class="custom-select" name="order[user_can_open_order]">
                                                    <option value="0">@lang('site.no')</option>
                                                    <option value="1">@lang('site.yes')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- second column --}}
                                <div class="col-md">
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_charge')
                                                </span>
                                            </label>
                                            <div class="col-sm-7">
                                                <select class="custom-select" name="shipping[charge_on]">
                                                    <option value="reciver">@lang('site.order_charge_reciver')</option>
                                                    <option value="sender">@lang('site.order_charge_sender')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_discount')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[discount]"
                                                    value="{{old('shipping.discount')}}"
                                                    class="form-control @error('shipping.discount') is-invalid @enderror"
                                                    id="order_discount"
                                                    placeholder="@lang('site.order_discount_placeholder')">

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_total_weight')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[total_weight]"
                                                    value="{{old('shipping.total_weight')}}"
                                                    class="form-control   @error('shipping.total_weight') is-invalid @enderror"
                                                    id="order_total_weight"
                                                    placeholder="@lang('site.order_total_weight')" readonly>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_total_over_weight')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[total_over_weight]"
                                                    value="{{old('shipping.total_over_weight')}}"
                                                    class="form-control  @error('shipping.total_over_weight') is-invalid @enderror"
                                                    id="order_total_over_weight"
                                                    placeholder="@lang('site.order_total_over_weight')" readonly>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_total_over_weight_price')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[total_over_weight_price]"
                                                    value="{{old('shipping.total_over_weight_price')}}"
                                                    class="form-control @error('shipping.total_over_weight_price') is-invalid @enderror"
                                                    id="order_total_over_weight_price"
                                                    placeholder="@lang('site.order_total_over_weight_price')" readonly>


                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_charge_price')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[charge_price]"
                                                    value="{{old('shipping.charge_price')}}"
                                                    class="form-control  @error('shipping.charge_price') is-invalid @enderror"
                                                    id="order_charge_price"
                                                    placeholder="@lang('site.order_charge_price')" readonly>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                <span class="text-gray-dark font-weight-normal">
                                                    @lang('site.order_total_price')
                                                </span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="shipping[total_price]"
                                                    value="{{old('shipping.total_price')}}"
                                                    class="form-control @error('shipping.total_price') is-invalid @enderror"
                                                    id="order_total_price" placeholder="@lang('site.order_total_price')"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">@lang('site.edit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@include('includes.scripts.set-values-to-inputs')