<div class="order-info">
    <div class="mb-3 br-1 text-center">
        <strong class="badge bg-purple p-3">

            @lang('site.order_info_title')</strong>
    </div>
    <div class="row">
        <div class="col-md">

            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_type')
                        </span>
                    </label>
                    <select class="custom-select col-sm-8" name="order[type]">
                        <option value="governorates_delivery">@lang('site.order_governorates_delivery')</option>
                        <option value="next_day_delivery">@lang('site.order_next_day_delivery')</option>
                        <option value="international_shipping">@lang('site.order_international_shipping')</option>
                        <option value="packaging_service">@lang('site.order_packaging_service')</option>
                        <option value="correspondents_service">@lang('site.order_correspondents_service')</option>
                        <option value="send_transmitters_service">@lang('site.order_send_transmitters_service')</option>
                        <option value="document_delivery_service">@lang('site.order_document_delivery_service')</option>
                        <option value="same_day_delivery">@lang('site.order_same_day_delivery')</option>
                    </select>
                </div>

            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_status')
                        </span>
                    </label>
                    <select class="custom-select col-sm-8" name="order[status]">
                        <option value="phone_from_customer">@lang('site.order_status_phone_from_customer')</option>
                        <option value="customer_store_in_company">@lang('site.order_status_customer_store_in_company')
                        </option>
                    </select>
                </div>

            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_weight')
                        </span>
                    </label>
                    <input type="text" name="shipping[weight]" value="{{old('shipping.weight')}}"
                        class="form-control col-sm-8  @error('shipping.weight') is-invalid @enderror" id="order_weight"
                        placeholder="@lang('site.order_weight_placeholder')">
                    @error('shipping.weight')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>

            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_quantity')
                        </span>
                    </label>
                    <input type="text" name="shipping[quantity]" value="{{old('shipping.quantity')}}"
                        class="form-control col-sm-8  @error('shipping.quantity') is-invalid @enderror" id="order_quantity"
                        placeholder="@lang('site.order_quantity_placeholder')">

                    @error('shipping.quantity')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_price')
                        </span>
                    </label>
                    <input type="text" name="shipping[price]" value="{{old('shipping.price')}}"
                        class="form-control col-sm-8  @error('shipping.price') is-invalid @enderror" id="order_price"
                        placeholder="@lang('site.order_price_placeholder')">

                    @error('shipping.rice')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-5 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_charge')
                        </span>
                    </label>
                    <select class="custom-select col-sm-7" name="shipping[charge_on]">
                        <option value="sender">@lang('site.order_charge_sender')</option>
                        <option value="reciver">@lang('site.order_charge_reciver')</option>
                    </select>
                </div>


            </div>

            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_info')
                        </span>
                    </label>
                    <textarea name="order[info]" class="form-control col-sm-8  @error('order.info') is-invalid @enderror"
                        id="order_info" rows="1"
                        placeholder="@lang('site.order_info_placeholder')">{{old('order.info')}}</textarea>
                    @error('order.info')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_notes')
                        </span>
                    </label>
                    <textarea name="order[notes]" class="form-control col-sm-8  @error('order.notes') is-invalid @enderror"
                        id="order_notes" rows="1"
                        placeholder="@lang('site.order_notes_placeholder')">{{old('order.order.notes')}}</textarea>

                    @error('order.notes')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        {{-- second column --}}
        <div class="col-md">
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_total_weight')
                        </span>
                    </label>
                    <input type="text" name="shipping[total_weight]" value="{{old('shipping.total_weight')}}"
                        class="form-control col-sm-8  @error('shipping.total_weight') is-invalid @enderror"
                        id="order_total_weight" placeholder="@lang('site.order_total_weight')" readonly>

                    @error('shipping.total_weight')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>

            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_total_over_weight')
                        </span>
                    </label>
                    <input type="text" name="shipping[total_over_weight]" value="{{old('shipping.total_over_weight')}}"
                        class="form-control col-sm-8  @error('shipping.total_over_weight') is-invalid @enderror"
                        id="order_total_over_weight" placeholder="@lang('site.order_total_over_weight')" readonly>

                    @error('shipping.total_over_weight')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_total_over_weight_price')
                        </span>
                    </label>
                    <input type="text" name="shipping[total_over_weight_price]"
                        value="{{old('shipping.total_over_weight_price')}}"
                        class="form-control col-sm-8  @error('shipping.total_over_weight_price') is-invalid @enderror"
                        id="order_total_over_weight_price" placeholder="@lang('site.order_total_over_weight_price')"
                        readonly>

                    @error('shipping.total_over_weight_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_discount')
                        </span>
                    </label>
                    <input type="text" name="shipping[discount]" value="{{old('shipping.discount')}}"
                        class="form-control col-sm-8  @error('shipping.discount') is-invalid @enderror" id="order_discount"
                        placeholder="@lang('site.order_discount_placeholder')">

                    @error('shipping.discount')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_charge_price')
                        </span>
                    </label>
                    <input type="text" name="shipping[charge_price]" value="{{old('shipping.charge_price')}}"
                        class="form-control col-sm-8  @error('shipping.charge_price') is-invalid @enderror"
                        id="order_charge_price" placeholder="@lang('site.order_charge_price')" readonly>

                    @error('shipping.charge_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_total_price')
                        </span>
                    </label>
                    <input type="text" name="shipping[total_price]" value="{{old('shipping.total_price')}}"
                        class="form-control col-sm-8  @error('shipping.total_price') is-invalid @enderror" id="order_total_price"
                        placeholder="@lang('site.order_total_price')" readonly>

                    @error('shipping.total_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md">
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label">
                        <span class="text-gray-dark font-weight-normal">
                            @lang('site.order_user_can_open_order')
                        </span>
                    </label>
                    <select class="custom-select col-sm-6" name="order[user_can_open_order]">
                        <option value="0">@lang('site.no')</option>
                        <option value="1">@lang('site.yes')</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row">

</div> --}}
