@extends('layouts.dashboard')

@section('login')
<div class="login-page">
    <div style="min-height: 512.391px;">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ route('dashboard.index') }}"><b>Admin</b>LTE</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="{{ route('auth.logedIn') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="@lang('site.admin_name')">
                            @error('name')
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
                            href="{{ route('auth.forget_password') }}">@lang('site.forget_password')</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('auth.reset_password') }}"
                            class="text-center">@lang('site.reset_password')</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
