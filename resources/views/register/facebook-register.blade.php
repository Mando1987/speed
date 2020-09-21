@extends('layouts.dashboard')

@section('login')
<div class="register-box" style="width: 400px !important">
    <div class="login-logo">
        <a href="{{ route('admin.index') }}"><b>@lang('site.website_name')</b> @lang('site.website_name_b')</a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">
                <img class="profile-user-img img-fluid img-circle" src="{{ session('facebook')['image'] }}" />
            </p>

        <form action="{{ route('facebook.register_proccess') }}" method="post">
            @csrf
            @method('POST')
                    <div class="col-md">
                        <div class="form-group row">
                            <div class="col-sm-4">
                            <x-label title="{{__('site.fullname')}}" value="{{ $data['fullname'] }}" />
                            </div>
                            <div class="col-sm-8">
                                <x-input name="admin[fullname]" type="text"/>
                            </div>
                        </div>
                </div>
                <div class="col-md">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <x-label title="{{__('site.phone')}}" />
                            </div>
                            <div class="col-sm-8">
                                <x-input name="admin[phone]" type="text"/>
                            </div>
                        </div>
                </div>
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.password')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input type="password" name="password" />
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.password_confirmation')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input type="password" name="password_confirmation" />
                        </div>
                    </div>
                </div>

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
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.address')}}" />
                        </div>
                        <div class="col-sm-8">
                            <x-input name="customerInfo[address]" type="text"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-block">@lang('site.register')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>

        <!-- /.form-box -->
    </div><!-- /.card -->
</div>

@endsection
