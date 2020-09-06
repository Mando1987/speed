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
                <form role="form" id="quickForm" action="{{ route('customer.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group col-md-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                    checked>
                                <label class="custom-control-label" for="is_active">@lang('site.active')</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md">
                                {{-- <label for="fullname">@lang('site.fullname')</label> --}}
                                <input type="text" name="fullname" value="{{old('fullname')}}"
                                    class="form-control @error('fullname') is-invalid @enderror" id="fullname"
                                    placeholder="@lang('site.fullname')">
                                @error('fullname')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md">
                                {{-- <label for="name">@lang('site.name')</label> --}}
                                <input type="text" name="user_name" value="{{old('user_name')}}"
                                    class="form-control @error('user_name') is-invalid @enderror" id="user_name"
                                    placeholder="@lang('site.name')">
                                @error('user_name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md">
                                {{-- <label for="phone">@lang('site.phone')</label> --}}
                                <input type="text" name="phone" value="{{old('phone')}}"
                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="@lang('site.phone')">
                                @error('phone')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md">
                                {{-- <label for="other_phone">@lang('site.other_phone')</label> --}}
                                <input type="text" name="other_phone" value="{{old('other_phone')}}"
                                    class="form-control @error('other_phone') is-invalid @enderror" id="other_phone"
                                    placeholder="@lang('site.other_phone')">
                                @error('other_phone')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row">

                            <div class="form-group col-md">
                                {{-- <label for="password">@lang('site.password')</label> --}}
                                <input type="password" name="password" value=""
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="@lang('site.password')">
                                @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md">
                                {{-- <label for="password_confirmation">@lang('site.password_confirmation')</label> --}}
                                <input type="password" name="password_confirmation" value=""
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" placeholder="@lang('site.password_confirmation')">
                                @error('password_confirmation')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        {{-- password and password_confimation --}}
                        <div class="row">
                            <div class="form-group col-md">
                                {{-- <label for="email">@lang('site.email')</label> --}}
                                <input type="email" name="email" value="{{old('email')}}"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="@lang('site.email')">
                                @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md">
                                {{-- <label for="email">@lang('site.email')</label> --}}
                                <input type="text" name="activity" value="{{old('activity')}}"
                                    class="form-control @error('activity') is-invalid @enderror" id="activity"
                                    placeholder="@lang('site.activity')">
                                @error('activity')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>




                        </div>
                        <div class="row">
                            <div class="form-group col-md">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.contract_type')
                                        </span>
                                    </div>
                                    <select class="custom-select" name="contract_type">
                                        <option value="daily">@lang('site.daily')</option>
                                        <option value="monthly">@lang('site.monthly')</option>
                                    </select>

                                </div>

                            </div>

                            <div class="form-group col-md">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.governorate')
                                        </span>
                                    </div>
                                    <select class="custom-select" name="governorate_id" id="governorate_id">
                                        @foreach($governorates as $governorate)
                                        <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="form-group col-md">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.city')
                                        </span>
                                    </div>
                                    <select class="custom-select" name="city_id" id="city_id">
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>



                        </div>

                        <div class="row">
                            <div class="form-group col-md">
                                {{-- <label for="address">@lang('site.address')</label> --}}
                                <input type="text" name="address" value="{{old('address')}}"
                                    class="form-control @error('address') is-invalid @enderror" id="address"
                                    placeholder="@lang('site.address')">
                                @error('address')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md">
                                {{-- <label for="special_marque">@lang('site.special_marque')</label> --}}
                                <input type="text" name="special_marque" value="{{old('special_marque')}}"
                                    class="form-control @error('special_marque') is-invalid @enderror"
                                    id="special_marque" placeholder="@lang('site.special_marque')">
                                @error('special_marque')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>

                        <div class="row">
                            <div class="form-group col-md">
                                {{-- <label for="house_number">@lang('site.house_number')</label> --}}
                                <input type="text" name="house_number" value="{{old('house_number')}}"
                                    class="form-control @error('house_number') is-invalid @enderror" id="house_number"
                                    placeholder="@lang('site.house_number')">
                                @error('house_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md">
                                {{-- <label for="door_number">@lang('site.door_number')</label> --}}
                                <input type="text" name="door_number" value="{{old('door_number')}}"
                                    class="form-control @error('door_number') is-invalid @enderror" id="door_number"
                                    placeholder="@lang('site.door_number')">
                                @error('door_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md">
                                {{-- <label for="shaka_number">@lang('site.shaka_number')</label> --}}
                                <input type="text" name="shaka_number" value="{{old('shaka_number')}}"
                                    class="form-control @error('shaka_number') is-invalid @enderror" id="shaka_number"
                                    placeholder="@lang('site.shaka_number')">
                                @error('shaka_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md">

                                <input type="text" name="company_name" value="{{old('company_name')}}"
                                    class="form-control @error('company_name') is-invalid @enderror" id="company_name"
                                    placeholder="@lang('site.company_name')">
                                @error('company_name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                {{-- <label for="facebook_page">@lang('site.facebook_page')</label> --}}
                                <input type="text" name="facebook_page" value="{{old('facebook_page')}}"
                                    class="form-control @error('facebook_page') is-invalid @enderror" id="facebook_page"
                                    placeholder="@lang('site.facebook_page')">
                                @error('facebook_page')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {{-- <label for="image">@lang('site.image')</label> --}}
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                name="image" id="image" onchange="loadFile(event)">
                                            <label class="custom-file-label"
                                                for="image">@lang('site.choose_image')</label>
                                            @error('image')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
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

