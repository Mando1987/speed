<form class="OrderFormSubmit" action="{{ route('order.validate_reciver') }}" method="POST">
    @csrf
    @method('POST')
    <div class="reciver-info">
        @include('order.includes.progressbar',['title'=> __('site.reciver_info_title'), 'progress' => 0, 'selected' => 1 , 'count' => 2])
        <div class="row mt-2 mb-2">
            <div class="col-6">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input chooseType" type="radio" name="reciverType" value="new"
                            id="ReciverNew" checked>
                        <label for="ReciverNew"
                            class="custom-control-label">@lang('site.order_create_new_reciver_manager')</label>
                    </div>
                </div>
            </div>
            <div class="col-6 border-left">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input chooseType" type="radio" name="reciverType" value="exists"
                            id="ReciverExists">
                        <label for="ReciverExists"
                            class="custom-control-label font-weight-bold">@lang('site.order_create_existing_reciver_'.$userData['adminType'])</label>
                    </div>
                    <div class="form-group row reciverTypeexists reciverType" style="display: none;">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.order_create_choose_reciver_'.$userData['adminType'])}}" />
                        </div>
                        <div class="col-sm-8">
                            <select class="custom-select" name="reciver[id]">
                                @foreach ($recivers as $reciver)
                                    <option value="{{ $reciver->id }}">{{ $reciver->fullname }}</option>
                                @endforeach
                           </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reciverTypenew reciverType">
            <div class="row">
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.fullname')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="reciver[fullname]" value="" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.phone')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="reciver[phone]" placeholder="{{__('site.phone_placholder')}}" value="" />
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
                            <x-input name="reciverAddress[address]" value=""
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
                            <x-input name="reciver[other_phone]" value=""
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
                            <x-Governorates name="reciver[]" data-name="reciver[city_id]"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.city')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-cities name="reciver[]" />
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
                            <x-input name="reciverAddress[special_marque]" value=""
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
                            <x-input name="reciverAddress[house_number]" value=""
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
                            <x-input name="reciverAddress[door_number]" value=""
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
                            <x-input name="reciverAddress[shaka_number]" value=""
                                placeholder="{{__('site.shaka_number_placholder')}}" />
                        </div>
                    </div>
                </div>
            </div><!-- end of row-->
        </div>
    </div>
    <a class="createOrderFormBack btn btn-outline-secondary" data-pane="customer">@lang('site.back')</a>
    <button type="submit" class="btn btn-secondary">@lang('site.next')</button>
</form>
