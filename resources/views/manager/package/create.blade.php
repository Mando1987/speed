@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ breadcrumbName() }} </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" novalidate="novalidate"
                    action="{{ route('package.store') }}" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="form-group col-6">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="@lang('site.package_name')">
                            @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">

                            <select class="custom-select" name="date">
                                <option value="">مدة الاشتراك</option>
                                @foreach(config('package.date') as $key => $date)
                            <option value="{{$key}}">@lang('site.' . $date)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" name="users" value="{{ old('users') }}"
                                class="form-control @error('users') is-invalid @enderror" id="users"
                                placeholder="@lang('site.package_users')">
                            @error('users')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">

                            <input type="text" name="routers" value="{{ old('routers') }}"
                                class="form-control @error('routers') is-invalid @enderror" id="routers"
                                placeholder="@lang('site.package_routers')">
                            @error('routers')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="price_eg" value="{{ old('price_eg') }}"
                                class="form-control @error('price_eg') is-invalid @enderror" id="price_eg"
                                placeholder="@lang('site.package_price_eg')">
                            @error('price_eg')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="price_us" value="{{ old('price_us') }}"
                                class="form-control @error('price_us') is-invalid @enderror" id="price_us"
                                placeholder="@lang('site.package_price_us')">
                            @error('price_us')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary">@lang('site.add')</button>

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
