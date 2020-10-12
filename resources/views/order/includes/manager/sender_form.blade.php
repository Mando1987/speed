<form action="{{ route('order.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="sender-info">
        <div class="row">
            <div class="col-md text-center">
                <strong class="badge bg-purple p-md-3 p-2 mb-3">
                    @lang('site.sender_info_title')
                </strong>
            </div>
            <div class="col-12">
                <div class="order-progress mx-auto d-flex justify-content-between">
                    <div class="order-line"></div>
                    <button class="btn btn-default rounded-circle">1</button>
                    <button class="btn btn-default rounded-circle">2</button>
                    <button class="btn btn-default rounded-circle">3</button>
                </div>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-6">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="newCustomer" name="chooseCustomer"
                            value="newCustomer">
                        <label for="newCustomer"
                            class="custom-control-label">@lang('site.order_create_new_sender')</label>
                    </div>
                </div>
            </div>
            <div class="col-6 border-left">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="existingCustomer" name="chooseCustomer"
                            checked="" value="existingCustomer">
                        <label for="existingCustomer"
                            class="custom-control-label font-weight-bold">@lang('site.order_create_existing_sender')</label>
                    </div>
                    <div class="form-group row existingCustomerContent">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.order_create_choose_customer')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-Customers name="customer_id" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="newCustomerContent" style="display: none">
            <div class="row">
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.fullname')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="customer[fullname]" value="{{ $userData->fullname}}"
                                placeholder="{{__('site.fullname_placholder')}}" />
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.phone')}}" />
                        </div>

                        <div class="col-sm-8">
                            <x-input name="customer[phone]" placeholder="{{__('site.phone_placholder')}}"
                                value="{{$userData->phone}}" />
                        </div>
                    </div>
                </div>
            </div> <!-- end of row-->
            <div class="row">
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.address')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="address[address]" value="{{$userData->address->address}}"
                                placeholder="{{__('site.address_placholder')}}" />
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.other_phone')}}" />
                        </div>

                        <div class="col-sm-8">
                            <x-input name="customer[other_phone]" value="{{$userData->other_phone}}"
                                placeholder="{{__('site.other_phone_placholder')}}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.governorate')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-Governorates name="customer[]" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.city')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-cities name="customer[]" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.special_marque')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="address[special_marque]" value="{{$userData->address->special_marque}}"
                                placeholder="{{__('site.special_marque_placholder')}}" />
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.house_number')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="address[house_number]" value="{{$userData->address->house_number}}"
                                placeholder="{{__('site.house_number_placholder')}}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.door_number')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="address[door_number]" value="{{$userData->address->door_number}}"
                                placeholder="{{__('site.door_number_placholder')}}" />
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.shaka_number')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="address[shaka_number]" value="{{$userData->address->shaka_number}}"
                                placeholder="{{__('site.shaka_number_placholder')}}" />
                        </div>
                    </div>
                </div>
            </div><!-- end of row-->
        </div>
    </div>
    <button type="submit" class="btn btn-secondary">@lang('site.next')</button>
</form>