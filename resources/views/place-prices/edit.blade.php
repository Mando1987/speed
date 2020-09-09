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
                <form role="form" id="quickForm" action="{{ route('price.update' , $city_price->city_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.governorate')
                                        </span>
                                    </div>
                                    <input type="text" value="{{$governorate_name}}" class="form-control">
                                    <input type="hidden" name="governorate_id" value="{{ $city_price->governorate_id }}">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.city')
                                        </span>
                                    </div>
                                        <input type="text" value="{{$city_name}}" class="form-control" >
                                        <input type="hidden" name="city_id" value="{{ $city_price->city_id }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.price_send_weight')
                                        </span>
                                    </div>
                                    <select class="custom-select" name="send_weight" id="send_weight">
                                        <option value="1" @if($city_price->send_weight == 1) selected @endif >@lang('site.price_send_weight_1k')</option>
                                        <option value="2" @if($city_price->send_weight == 2) selected @endif >@lang('site.price_send_weight_2k')</option>
                                        <option value="3" @if($city_price->send_weight == 3) selected @endif >@lang('site.price_send_weight_3k')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.price_send_price')
                                        </span>
                                    </div>
                                    <input type="text" name="send_price" value="{{$city_price->send_price}}"
                                        class="form-control @error('send_price') is-invalid @enderror" id="send_price"
                                        placeholder="@lang('site.price_send_price')">
                                    @error('send_price')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.price_weight_addtion')
                                        </span>
                                    </div>
                                    <select class="custom-select" name="weight_addtion" id="weight_addtion">
                                        <option value="0.5" @if($city_price->weight_addtion == 0.5) selected @endif>@lang('site.price_send_weight_.5k')</option>
                                        <option value="1"   @if($city_price->weight_addtion == 1) selected @endif>@lang('site.price_send_weight_1k')</option>
                                        <option value="2"   @if($city_price->weight_addtion == 2) selected @endif>@lang('site.price_send_weight_2k')</option>
                                        <option value="3"   @if($city_price->weight_addtion == 3) selected @endif>@lang('site.price_send_weight_3k')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.price_price_addtion')
                                        </span>
                                    </div>
                                    <input type="text" name="price_addtion" value="{{$city_price->price_addtion}}"
                                        class="form-control @error('price_addtion') is-invalid @enderror"
                                        id="price_addtion" placeholder="@lang('site.price_price_addtion')">
                                    @error('price_addtion')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary">@lang('site.edit')</button>

                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12-6">

        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</div>
@endsection
