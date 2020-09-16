
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card ">
                <form  class="addPlacePrice" action="{{ route('price.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="badge bg-secondary pt-3">
                                            @lang('site.price_send_weight')
                                        </span>
                                    </div>
                                    <select class="custom-select" name="send_weight" id="send_weight">
                                        <option value="1">@lang('site.price_send_weight_1k')</option>
                                        <option value="2">@lang('site.price_send_weight_2k')</option>
                                        <option value="3">@lang('site.price_send_weight_3k')</option>
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
                                    <input type="text" name="send_price" value="{{old('send_price')}}"
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
                                        <option value="0.5">@lang('site.price_send_weight_.5k')</option>
                                        <option value="1">@lang('site.price_send_weight_1k')</option>
                                        <option value="2">@lang('site.price_send_weight_2k')</option>
                                        <option value="3">@lang('site.price_send_weight_3k')</option>
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
                                    <input type="text" name="price_addtion" value="{{old('price_addtion')}}"
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
                    <input type="hidden" name="governorate_id" value="{{ $governorate_id }}">
                        <input type="hidden" name="city_id"    value="{{ $city_id }}">
                        <button type="submit" class="btn btn-primary">@lang('site.add')</button>

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

