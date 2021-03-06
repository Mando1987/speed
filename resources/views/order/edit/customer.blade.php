@extends('layouts/dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-purple card-outline">
                <form id="FormSubmit" action="{{ route('customer.updateByOrder' , $userData['customer']->id) }}" method="POST">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="sender-info">
                            <div class="newContent">
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <x-label title="{{__('site.fullname')}}" />
                                            </div>
                                            <div class="col-sm-8">
                                                <x-input name="customer[fullname]"
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
                                                <x-input name="customer[phone]"
                                                    placeholder="{{__('site.phone_placholder')}}"
                                                     />
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
                                                <x-input name="address[address]"
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
                                                <x-input name="customer[other_phone]"
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
                                                <x-input name="address[special_marque]"

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
                                                <x-input name="address[house_number]"

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
                                                <x-input name="address[door_number]"

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
                                                <x-input name="address[shaka_number]"

                                                    placeholder="{{__('site.shaka_number_placholder')}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of row-->
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $userData['customer']->id }}" />
                        <button type="submit" class="btn btn-success">@lang('site.edit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@include('includes.scripts.set-values-to-inputs')