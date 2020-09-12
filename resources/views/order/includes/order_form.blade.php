<div class="order-info">
    <div class="row">
        <div class="col-md mb-2 br-1">
            <strong class="badge badge-danger p-2"><i class="far fa-clock"></i>
                @lang('site.order_info_title')</strong>
        </div>


    </div>
    <div class="row">
        <div class="col-md">
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_type')
                        </span>
                    </div>
                    <select class="custom-select" name="order[order_type]">
                        <option value="3">توصيل محافظات</option>
                        <option value="2">توصيل تانى يوم</option>
                        <option value="5">شحن دولي</option>
                        <option value="6">خدمة التغليف</option>
                        <option value="7">خدمة المراسلين</option>
                        <option value="8">خدمة ارسال المرسلات</option>
                        <option value="9">خدمة توصيل المستندات</option>
                        <option value="1">توصيل في نفس اليوم</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_weight')
                        </span>
                    </div>
                    <input type="text" name="order[order_weight]" value="{{old('order.order_weight')}}"
                        class="form-control @error('order.order_weight') is-invalid @enderror" id="order_weight"
                        placeholder="@lang('site.order_weight')">
                    @error('order.order_weight')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_quantity')
                        </span>
                    </div>
                    <input type="text" name="order[order_quantity]" value="{{old('order.order_quantity')}}"
                        class="form-control @error('order.order_quantity') is-invalid @enderror" id="order_quantity"
                        placeholder="@lang('site.order_quantity')">
                    @error('order.order_quantity')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_charge')
                        </span>
                    </div>
                    <select class="custom-select" name="order[order_charge_on]">
                        <option value="order_charge_sender">@lang('site.order_charge_sender')</option>
                        <option value="order_charge_reciver">@lang('site.order_charge_reciver')</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_price')
                        </span>
                    </div>
                    <input type="text" name="order[order_price]" value="{{old('order.order_price')}}"
                        class="form-control @error('order.order_price') is-invalid @enderror" id="order_price"
                        placeholder="@lang('site.order_price')">
                    @error('order.order_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_charge_price')
                        </span>
                    </div>
                    <input type="text" name="order[order_charge_price]" value="{{old('order.order_charge_price')}}"
                        class="form-control @error('order.order_charge_price') is-invalid @enderror"
                        id="order_charge_price" placeholder="@lang('site.order_charge_price')" disabled>
                    @error('order.order_charge_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_total_price')
                        </span>
                    </div>
                    <input type="text" name="order[order_total_price]" value="{{old('order.order_total_price')}}"
                        class="form-control @error('order.order_total_price') is-invalid @enderror"
                        id="order_total_price" placeholder="@lang('site.order_total_price')" disabled>
                    @error('order.order_total_price')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_status')
                        </span>
                    </div>
                    <select class="custom-select" name="order[order_status]">
                        <option value="phone_from_empolyee">@lang('site.order_status_phone_from_empolyee')</option>
                        <option value="employee_store_in_company">@lang('site.order_status_employee_store_in_company')</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="col-md">
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_info')
                        </span>
                    </div>
                    <textarea name="order[order_info]"
                        class="form-control @error('order.order_info') is-invalid @enderror" id="order_info" rows="4"
                        placeholder="@lang('site.order_info')">
                   {{old('order.order.order_info')}}</textarea>

                    @error('order.order_info')
                       <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.order_notes')
                        </span>
                    </div>
                    <textarea name="order[order_notes]"
                        class="form-control @error('order.order_notes') is-invalid @enderror" id="order_notes" rows="4"
                        placeholder="@lang('site.order_notes')">
                   {{old('order.order.order_notes')}}</textarea>

                    @error('order.order_notes')
                       <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>

{{-- <div class="row">

</div> --}}