@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-purple card-outline">

                <!-- form start -->
                <form role="form" id="quickForm" action="{{ route('customer.update' , $data['customer']['id']) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group col-md-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                    @if($data['admin']['is_active']==1) checked @endif>
                                <label class="custom-control-label" for="is_active">@lang('site.active')</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.fullname')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input-text name="admin[fullname]" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.user_name')}}" />
                                    </div>

                                    <div class="col-sm-8">
                                        <x-input-text name="admin[user_name]" />
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of row-->

                        <div class="row">
                            <div class="col-md">
                                <div class="col-md">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <x-label title="{{__('site.phone')}}" />
                                        </div>

                                        <div class="col-sm-8">
                                            <x-input-text name="admin[phone]" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="col-md">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <x-label title="{{__('site.other_phone')}}" />
                                        </div>

                                        <div class="col-sm-8">
                                            <x-input-text name="customer[other_phone]" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end of row-->

                        {{-- <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.password')}}" />
                    </div>
                    <div class="col-sm-8">
                        <x-input-text type="password" name="password" />
                    </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.password_confirmation')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text type="password" name="password_confirmation" />
                </div>
            </div>
        </div>

    </div><!-- end of row--> --}}
    <div class="row">
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.email')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text type="email" name="admin[email]" />
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.activity')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text name="customerInfo[activity]" />
                </div>
            </div>
        </div>

    </div> <!-- end of row-->

    <div class="row">
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.contract_type')}}" />
                </div>
                <div class="col-sm-8">
                    <select class="custom-select" name="customer[contract_type]">
                        <option value="daily">@lang('site.daily')</option>
                        <option value="monthly">@lang('site.monthly')</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.company_name')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text name="customer[company_name]" />
                </div>
            </div>
        </div>
    </div><!-- end of row-->

    <div class="row">
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.governorate')}}" />
                </div>
                <div class="col-sm-8">
                    <x-Governorates name="customer[]" />
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.city')}}" />
                </div>
                <div class="col-sm-8">
                    <x-cities name="customer[]" />
                </div>
            </div>
        </div>
    </div><!-- end of row-->

    <div class="row">
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.address')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text name="customerInfo[address]" />
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.special_marque')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text name="customerInfo[special_marque]" />
                </div>
            </div>
        </div>
    </div><!-- end of row-->
    <div class="row">
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.house_number')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text name="customerInfo[house_number]" />
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.door_number')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text name="customerInfo[door_number]" />
                </div>
            </div>
        </div>
    </div><!-- end of row-->
    <div class="row">
        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.shaka_number')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text name="customerInfo[shaka_number]" />
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.facebook_page')}}" />
                </div>
                <div class="col-sm-8">
                    <x-input-text name="customer[facebook_page]" />
                </div>
            </div>
        </div>
    </div><!-- end of row-->

    <div class="row">
        <div class="col-6">
            <div class="form-group row">
                <div class="col-sm-4">
                    <x-label title="{{__('site.image')}}" />
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                name="image" id="image" >
                            <label class="custom-file-label" for="image">@lang('site.choose_image')</label>
                            @error('image')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="col-6">
            <div class="text-center float-left">
                <img id="image-privew" class="profile-user-img img-fluid img-circle"
                    src="{{ asset('/uploads/images/default.png') }}">
            </div>
        </div> --}}
    </div><!-- end of row-->

</div>
<!-- /.card-body -->
<div class="card-footer">
    <input type="hidden" name="admin_id" value="{{ $data['admin']['id'] }}" />
    <input type="hidden" name="customer_id" value="{{ $data['customer']['id'] }}" />
    <button type="submit" class="btn btn-success">@lang('site.edit')</button>
</div>
</form>
</div>
<!-- /.card -->
</div>
<!--/.col (left) -->
<!-- right column -->
<div class="col-md-6">

</div>
<!--/.col (right) -->
</div>
<!-- /.row -->
</div>
@endsection

@push('scripts')
    <script>
        $(function () {
            /**
             *   data = [customer => [] , admin=[] , customerInfo=[]]
             *  parentKey = customer , admin , customerInfo
             */
            var data = @json($data);
            $.each(data, function (parentKey, array) {

                $.each(array, function (key, val) {
                    $('[name="' + parentKey + '[' + key + ']"]').val(val);
                });
            });
            $('#city_id').attr('data', data.customer.city_id);
            $('#governorate_id').trigger('change');
        });
    </script>
@endpush
