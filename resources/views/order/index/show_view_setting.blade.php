<!-- start of card -->
<div class="card card-purple card-outline m-0">
    <!-- start of card-body -->
    <div class="card-body">
        <form action="{{ url('order/view-setting') }}" method="POST">
          @csrf
          @method('POST')
            <div class="row">
                <div class="col-4">
                    <span class="font-weight-bold">@lang('site.option_view_style')</span>
                </div>
                <div class="col-8">
                    <div class="form-group clearfix float-left">
                        <div class="custom-control custom-radio d-inline">
                            <input class="custom-control-input" type="radio" id="view1" name="viewSetting[view_mode]" value="list"
                                @if($viewSetting['view_mode']=='list') checked @endif>
                            <label for="view1" class="custom-control-label">
                                <i class="fas fa-bars"></i>
                            </label>
                        </div>
                        <div class="custom-control custom-radio d-inline ml-3">
                            <input class="custom-control-input" type="radio" id="view2" name="viewSetting[view_mode]" @if($viewSetting['view_mode']=='grid' )
                                checked @endif value="grid">
                            <label for="view2" class="custom-control-label">
                                <i class="fas fa-th"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!--end of row-->
            <div class="row">
                <div class="col-4">
                    <span class="font-weight-bold">{{__('site.show_records_number')}}</span>
                </div>
                <div class="col-8">
                    <div class="form-group row">
                        <select class="custom-select custom-select-sm font-weight-bold" name="viewSetting[paginate]">
                            @foreach(range(5,50,5) as $number)
                            <option class="font-weight-bold" value="{{ $number }}" @if($number == $viewSetting['paginate']) selected @endif/>{{ $number }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!--end of row-->
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3">
                    <button type="submit" class="btn btn-success btn-sm btn-block">@lang('site.save')</button>
                </div>
            </div>
        </form><!-- end of form -->
    </div>
    <!-- start of card-body -->
</div>
<!-- end of card -->
