<form class="OrderFormSubmit" action="{{ route('order.store') }}" method="POST">
    @csrf
    @method('POST')
<div class="order-info">
    @include('order.includes.progressbar',['title'=> __('site.order_info_title'), 'progress' => 100, 'selected' => 3])
    <div class="row">
        <div class="col-md">
            <!-- start col-->
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_type')}}" />
                        </span>
                    </div>
                    <div class="col-sm-8">
                        <select class="custom-select" name="order[type]">
                            <option value="next_day_delivery">@lang('site.order_next_day_delivery')</option>
                            <option value="governorates_delivery">@lang('site.order_governorates_delivery')</option>
                            <option value="international_shipping">@lang('site.order_international_shipping')</option>
                            <option value="packaging_service">@lang('site.order_packaging_service')</option>
                            <option value="correspondents_service">@lang('site.order_correspondents_service')</option>
                            <option value="send_transmitters_service">@lang('site.order_send_transmitters_service')
                            </option>
                            <option value="document_delivery_service">@lang('site.order_document_delivery_service')
                            </option>
                            <option value="same_day_delivery">@lang('site.order_same_day_delivery')</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_weight')}}" />
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[weight]"
                            class="form-control  " id="order_weight"
                            placeholder="@lang('site.order_weight_placeholder')">
                        @error('shipping.weight')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_quantity')}}" />
                        </span>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[quantity]"
                            class="form-control   " id="order_quantity"
                            placeholder="@lang('site.order_quantity_placeholder')">
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_price')}}" />
                        </span>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[price]"
                            class="form-control  " id="order_price"
                            placeholder="@lang('site.order_price_placeholder')">
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_info')}}" />
                        </span>
                    </div>
                    <div class="col-sm-8">
                        <textarea name="order[info]" class="form-control "
                            id="order_info" rows="1"
                            placeholder="@lang('site.order_info_placeholder')">{{old('order.info')}}</textarea>
                    </div>
                </div>

            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">

                           <x-label title="{{__('site.order_notes')}}" />
                        </span>
                    </div>
                    <div class="col-sm-8">
                        <textarea name="order[notes]" class="form-control  "
                            id="order_notes" rows="1"
                            placeholder="@lang('site.order_notes_placeholder')">{{old('order.order.notes')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_user_can_open_order')}}" />
                        </span>
                    </div>
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
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_charge')}}" />
                        </span>
                    </div>
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
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_discount')}}" />
                        </span>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[discount]"
                            class="form-control" id="order_discount"
                            placeholder="@lang('site.order_discount_placeholder')">
                    </div>

                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">

                           <x-label title="{{__('site.order_total_weight')}}" />
                        </span>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[total_weight]"
                            class="form-control   "
                            id="order_total_weight" placeholder="@lang('site.order_total_weight')" readonly>

                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_total_over_weight')}}" />
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[total_over_weight]"

                            class="form-control  "
                            id="order_total_over_weight" placeholder="@lang('site.order_total_over_weight')" readonly>

                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">

                           <x-label title="{{__('site.order_total_over_weight_price')}}" />
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[total_over_weight_price]"

                            class="form-control "
                            id="order_total_over_weight_price" placeholder="@lang('site.order_total_over_weight_price')"
                            readonly>
                    </div>
                </div>


            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">

                           <x-label title="{{__('site.order_charge_price')}}" />
                        </span>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[charge_price]"
                            class="form-control  "
                            id="order_charge_price" placeholder="@lang('site.order_charge_price')" readonly>

                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <div class="col-sm-4">
                           <x-label title="{{__('site.order_total_price')}}" />
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="shipping[total_price]"
                            class="form-control "
                            id="order_total_price" placeholder="@lang('site.order_total_price')" readonly>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<a class="createOrderFormBack btn btn-outline-secondary" data-pane="reciver">@lang('site.back')</a>
<button type="submit" class="btn btn-success">@lang('site.add')</button>
</form>
