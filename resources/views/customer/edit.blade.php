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
                        @if(currentAdminType() == 'manager')
                        <div class="form-group col-md-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                    @if($data['admin']['is_active']==1) checked @endif>
                                <label class="custom-control-label" for="is_active">@lang('site.active')</label>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="is_active" value="1">
                        @endif
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.fullname')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="admin[fullname]" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.user_name')}}" />
                                    </div>

                                    <div class="col-sm-8">
                                        <x-input name="admin[user_name]" />
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of row-->
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.phone')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="admin[phone]" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.other_phone')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="admin[other_phone]" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.email')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input type="email" name="admin[email]" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.activity')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="customer[activity]" />
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
                                        <x-input name="customer[company_name]" />
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
                                        <x-Governorates name="customer[]" data-name="customer[city_id]"/>
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
                                        <x-input name="address[address]" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.special_marque')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="address[special_marque]" />
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
                                        <x-input name="address[house_number]" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.door_number')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="address[door_number]" />
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
                                        <x-input name="address[shaka_number]" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.facebook_page')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="customer[facebook_page]" />
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
                                                <input type="file"
                                                    class="custom-file-input @error('image') is-invalid @enderror"
                                                    name="image" id="image">
                                                <label class="custom-file-label"
                                                    for="image">@lang('site.choose_image')</label>
                                                @error('image')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

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
            var data = @json($data);
            $.each(data, function (parentKey, array) {

                $.each(array, function (key, val) {
                    $('[name="' + parentKey + '[' + key + ']"]').val(val);
                });
            });
            $('.governorate_id').trigger('change',[data.customer.city_id]);
        });
</script>
@endpush
