@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ breadcrumbName() }} </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" id="quickForm" novalidate="novalidate"
                    action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-md-6">
                            <label for="name">@lang('site.role_name')</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="@lang('site.role_name_placeholder')">
                            @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- start --}}
                        <div class="col-12">
                            <div class="card card-default card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        @foreach($tags as $tag)

                                            <li class="nav-item">
                                                <a class="nav-link @if($loop->first) active @endif"
                                                    id="custom-tabs-one-{{ $tag }}-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-{{ $tag }}" role="tab"
                                                    aria-controls="custom-tabs-one-{{ $tag }}"
                                                    aria-selected="true">@lang('site.' . $tag)</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        @foreach($tags as $tag)
                                        <div class="tab-pane fade @if($loop->first) active show @endif" id="custom-tabs-one-{{ $tag }}" role="tabpanel"
                                            aria-labelledby="custom-tabs-one-{{ $tag }}-tab">
                                            @foreach ($permissions as $permission)
                                                 @if($permission->tag == $tag)
                                                 <div class="form-group col-md-4">
                                                    <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="{{ $permission->name }}" name="permissions[]" value="{{$permission->id}}" @if($loop->first) checked @endif>
                                                        <label class="custom-control-label" for="{{ $permission->name }}">@lang('permission.'. $permission->name) </label>
                                                    </div>
                                                </div>
                                                 @endif 
                                            @endforeach
                                        </div>
                                        
                                        @endforeach
                                        
                                       
                                    </div>
                                    @error('permission')
                                      <span class="text-danger bold">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        {{-- start --}}
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        
                        <button type="submit" class="btn btn-primary">@lang('site.add')</button>

                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
