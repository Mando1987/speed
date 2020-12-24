<form class="OrderFormSubmit" action="{{ route('order.validate_customer') }}" method="POST">
    @csrf
    @method('POST')
    <div class="sender-info">
        @include('order.includes.progressbar',['title'=> __('site.sender_info_title'),'progress' => 0,'selected' => 1])
        <!-- choose between new customer or exists customer -->
        <div class="row mt-2 mb-2">
            <div class="col-6">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input chooseType" type="radio" name="customerType" value="new"
                            id="customerNew" checked>
                        <label for="customerNew"
                            class="custom-control-label">@lang('site.order_create_new_sender')</label>
                    </div>
                </div>
            </div>
            @if($customers)
            <div class="col-6 border-left">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input chooseType" type="radio" name="customerType" value="exists"
                            id="customerExists">
                        <label for="customerExists"
                            class="custom-control-label font-weight-bold">@lang('site.order_create_existing_sender')</label>
                    </div>
                    <div class="form-group row customerTypeexists customerType" style="display: none">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.order_create_choose_customer')}}" />
                        </div>
                        <div class="col-sm-8">
                            <select class="custom-select" name="customer_id" id="customer_id">
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- choose between new customer or exists customer -->

        <div class="customerTypenew customerType">
            <div class="row">
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.fullname')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="customer[fullname]" value=""
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
                            <x-input name="customer[phone]" placeholder="{{__('site.phone_placholder')}}" value="" />
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
                            <x-input name="customerAddress[address]" value=""
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
                            <x-input name="customer[other_phone]" value=""
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
                            <x-Governorates name="customer[]" data-name="customer[city_id]" />
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
                            <x-input name="customerAddress[special_marque]" value=""
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
                            <x-input name="customerAddress[house_number]" value=""
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
                            <x-input name="customerAddress[door_number]" value=""
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
                            <x-input name="customerAddress[shaka_number]" value=""
                                placeholder="{{__('site.shaka_number_placholder')}}" />
                        </div>
                    </div>
                </div>
            </div><!-- end of row-->
        </div>
    </div>
    <button type="submit" class="btn btn-secondary">@lang('site.next')</button>
</form>
