@extends('layouts.login')
@section('content')
<div class="register-box" style="width: 400px !important">
    <div class="login-logo">
        <a href="{{ route('admin.index') }}"><b>@lang('site.website_name')</b> @lang('site.website_name_b')</a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg"></p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            @method('POST')

                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.fullname')}}" />
                        </div>
                        <div class="col-sm">
                            <x-input name="admin[fullname]"  type="text"/>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.user_name')}}" />
                        </div>

                        <div class="col-sm-8">
                            <x-input name="admin[user_name]" type="text"/>
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
                    <div class="col-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
            <a href="{{ route('facebook.login') }}" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    @lang('site.facebook_register')
                </a>

            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>

@endsection
