@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <form id="FormSubmit" action="{{ route('delegate.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card card-purple card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="admin[is_active]" checked>
                                    <label class="custom-control-label" for="is_active">@lang('site.delegate_active')</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.fullname')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                    <x-input name="admin[fullname]" value="{{ old('admin.fullname') }}"
                                            placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.qualification')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="delegate[qualification]" value="{{ old('delegate.qualification') }}"
                                    placeholder="{{ __('site.qualification_placeholder') }}" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of row-->
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.national_id')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="delegate[national_id]" value="{{ old('delegate.national_id') }}"
                                    placeholder="{{ __('site.national_id_placeholder') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.social_status')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="delegate[social_status]" class="custom-select">
                                            <option value="single">@lang('site.social_status_single')</option>
                                            <option value="married">@lang('site.social_status_married')</option>
                                            <option value="divorce">@lang('site.social_status_divorce')</option>
                                            <option value="widower">@lang('site.social_status_widower')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of row-->
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.phone')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="admin[phone]" value="{{ old('admin.phone') }}"
                                            placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.other_phone')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="admin[other_phone]" value="{{ old('admin.other_phone') }}"
                                    placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.governorate')}}"/>
                                    </div>
                                    <div class="col-sm-8">
                                        <x-Governorates name="delegate[]"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.city')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                    <x-cities name="delegate[]"/>
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
                                        <x-input name="delegate[address]" value=""
                                            placeholder="{{__('site.address_placholder')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.driveType')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="delegateDrive[type]">
                                            <option value="motocycle">@lang('site.driveType_motocycle')</option>
                                            <option value="car">@lang('site.driveType_car')</option>
                                            <option value="trocycle">@lang('site.driveType_trocycle')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- start delegateDrive information ########################################################### -->
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.driveColor')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="delegateDrive[color]" value=""
                                            placeholder="{{__('site.driveColor_placeholder')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.drivePlate_number')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="delegateDrive[plate_number]" value=""
                                            placeholder="{{__('site.driveplate_number_placeholder')}}" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.image')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group @error('delegate.image') is-invalid @enderror">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image"
                                                    >
                                                <label class="custom-file-label" for="image">إختار صورة</label>
                                            </div>
                                        </div>
                                        @error('delegate.image')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.national_image')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group @error('delegate.national_image') is-invalid @enderror">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    name="national_image" >
                                                <label class="custom-file-label" for="national_image">إختار صورة</label>
                                            </div>
                                        </div>
                                        @error('delegate.national_image')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of row-->
                        <!-- start delegateDrive information ########################################################### -->
                    </div><!-- end of card-body-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">@lang('site.add')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

