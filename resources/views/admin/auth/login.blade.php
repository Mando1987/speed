@extends('layouts.login')
@section('content')
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ route('admin.index') }}"><b>@lang('site.website_name')</b> @lang('site.website_name_b')</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">@lang('site.login_title')</p>

                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" name="user_name" value="{{ old('email') ?? old('phone') }}"
                                class="form-control @error('phone') is-invalid @enderror @error('email') is-invalid @enderror"
                                placeholder="@lang('site.admin_user_name')">
                            @error('phone')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" value="{{ old('password') }}"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="@lang('site.admin_password')">

                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remmber_me">
                                    <label for="remember">
                                        @lang('site.remmber_me')
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">@lang('site.login')</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-1">
                        <a
                            href="{{ route('admin.password.request') }}">@lang('site.forget_password')</a>
                    </p>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>

@endsection
