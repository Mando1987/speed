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
                <form role="form" id="quickForm" 
                    action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group col-md-2">
                            <div class="custom-control custom-switch" >
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" checked>
                                <label class="custom-control-label" for="is_active">@lang('site.admin_active')</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fullname">@lang('site.admin_fullname')</label>
                                <input type="text" name="fullname" value="{{old('fullname')}}"
                                    class="form-control @error('fullname') is-invalid @enderror" id="fullname"
                                    placeholder="@lang('site.admin_fullname')">
                                @error('fullname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">@lang('site.admin_name')</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="@lang('site.admin_name')">
                                @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="role_id">@lang('site.admin_role_id')</label>
                                <select class="custom-select" name="role_id">
                                    @foreach($allRoles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">@lang('site.admin_phone')</label>
                                <input type="text"  name="phone" value="{{old('phone')}}"
                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="@lang('site.admin_phone')">
                                @error('phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div> 
                           
                        </div>
                        <div class="row">
                         
                            <div class="form-group col-md-6">
                                <label for="password">@lang('site.admin_password')</label>
                                <input type="password" name="password" value=""  class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="@lang('site.admin_password')">
                                @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">@lang('site.admin_password_confirmation')</label>
                                <input type="password" name="password_confirmation" value=""  class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                    placeholder="@lang('site.admin_password_confirmation')">
                                @error('password_confirmation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                        {{-- password and password_confimation --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">@lang('site.admin_email')</label>
                                <input type="email" name="email" value="{{old('email')}}"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="@lang('site.admin_email')">
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address">@lang('site.admin_address')</label>
                                <input type="text" name="address" value="{{old('address')}}"
                                    class="form-control @error('address') is-invalid @enderror" id="address"
                                    placeholder="@lang('site.admin_address')">
                                @error('address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="admin-image">@lang('site.admin_image')</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="admin-image" onchange="loadFile(event)">
                                        <label class="custom-file-label" for="admin-image">@lang('site.admin_choose_image')</label>
                                        @error('image')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                      </div>
                                    </div>
                                  </div>   
                            </div>
                            <div class="col-6">
                                <div class="text-center float-left">
                                    <img id="image-privew" class="profile-user-img img-fluid img-circle" src="{{ asset('/uploads/images/default.png') }}">
                                    </div>
                            </div>
                           
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


