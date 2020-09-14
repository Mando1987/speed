<div class="order-info">
    <div class="mb-3 br-1 text-center">
        <strong class="badge bg-purple p-3">

            @lang('site.order_info_title')</strong>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_type')
                        </span>
                    </div>
                    <select class="custom-select" name="order[type]">
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
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_status')
                        </span>
                    </div>
                    <select class="custom-select" name="order[status]">
                        <option value="phone_from_empolyee">@lang('site.order_status_phone_from_empolyee')</option>
                        <option value="employee_store_in_company">@lang('site.order_status_employee_store_in_company')
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_weight')
                        </span>
                    </div>
                    <input type="text" name="order[weight]" value="{{old('order.weight')}}"
                        class="form-control  @error('order.weight') is-invalid @enderror" id="order_weight"
                        placeholder="@lang('site.order_weight_placeholder')" >
                    @error('order.weight')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_quantity')
                        </span>
                    </div>
                    <input type="text" name="order[quantity]" value="{{old('order.quantity')}}"
                        class="form-control  @error('order.order_quantity') is-invalid @enderror" id="order_quantity"
                        placeholder="@lang('site.order_quantity_placeholder')"
                        data-inputmask="'mask': ['9[9][9][9][9]']" data-mask="" im-insert="true">

                    @error('order.quantity')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_price')
                        </span>
                    </div>
                    <input type="text" name="order[price]" value="{{old('order.price')}}"
                        class="form-control  @error('order.price') is-invalid @enderror" id="order_price"
                        placeholder="@lang('site.order_price_placeholder')">

                    @error('order.rice')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_charge')
                        </span>
                    </div>
                    <select class="custom-select" name="order[charge_on]">
                        <option value="charge_sender">@lang('site.order_charge_sender')</option>
                        <option value="charge_reciver">@lang('site.order_charge_reciver')</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_info')
                        </span>
                    </div>
                    <textarea name="order[info]"
                        class="form-control  @error('order.info') is-invalid @enderror" id="order_info" rows="1"
                        placeholder="@lang('site.order_info_placeholder')">{{old('order.info')}}</textarea>
                    @error('order.info')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_notes')
                        </span>
                    </div>
                    <textarea name="order[notes]"
                        class="form-control  @error('order.notes') is-invalid @enderror" id="order_notes" rows="1"
                        placeholder="@lang('site.order_notes_placeholder')">{{old('order.order.notes')}}</textarea>

                    @error('order.notes')
                       <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>
        {{-- second column --}}
        <div class="col-md">
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_total_weight')
                        </span>
                    </div>
                    <input type="text" name="order[total_weight]" value="{{old('order.total_weight')}}"
                        class="form-control  @error('order.total_weight') is-invalid @enderror"
                        id="order_total_weight" placeholder="@lang('site.order_total_weight')" disabled>

                    @error('order.total_weight')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_total_over_weight')
                        </span>
                    </div>
                    <input type="text" name="order[total_over_weight]"
                        value="{{old('order.total_over_weight')}}"
                        class="form-control  @error('order.total_over_weight') is-invalid @enderror"
                        id="order_total_over_weight" placeholder="@lang('site.order_total_over_weight')" disabled>

                    @error('order.total_over_weight')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_total_over_weight_price')
                        </span>
                    </div>
                    <input type="text" name="order[total_over_weight_price]"
                        value="{{old('order.total_over_weight_price')}}"
                        class="form-control  @error('order.total_over_weight_price') is-invalid @enderror"
                        id="order_total_over_weight_price" placeholder="@lang('site.order_total_over_weight_price')"
                        disabled>

                    @error('order.total_over_weight_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_discount')
                        </span>
                    </div>
                    <input type="text" name="order[discount]" value="{{old('order.discount')}}"
                        class="form-control  @error('order.discount') is-invalid @enderror" id="order_discount"
                        placeholder="@lang('site.order_discount_placeholder')">

                    @error('order.discount')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_charge_price')
                        </span>
                    </div>
                    <input type="text" name="order[charge_price]" value="{{old('order.charge_price')}}"
                        class="form-control  @error('order.charge_price') is-invalid @enderror"
                        id="order_charge_price" placeholder="@lang('site.order_charge_price')" disabled>

                    @error('order.charge_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3 w-100">
                            @lang('site.order_total_price')
                        </span>
                    </div>
                    <input type="text" name="order[total_price]" value="{{old('order.total_price')}}"
                        class="form-control  @error('order.total_price') is-invalid @enderror"
                        id="order_total_price" placeholder="@lang('site.order_total_price')" disabled>

                    @error('order.total_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend" style="width: 170px">
                        <span class="badge bg-info  pt-3 w-100">
                            @lang('site.order_user_can_open_order')
                        </span>
                    </div>
                    <select class="custom-select" name="order[user_can_open_order]">
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
