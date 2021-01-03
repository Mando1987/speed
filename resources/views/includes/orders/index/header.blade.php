<form class="w-100" id="changeStatus" action="{{ route('order.index') }}" method="GET">
    <div class="row d-flex align-items-stretch">
        <!-- start of status  -->
        <div class="col-12 col-sm-5 col-md-5  d-flex align-items-stretch mb-1">
            <select class="custom-select custom-select-sm" id="orderStatus" name="status">
                <option value="all">@lang('site.dashboard_all_orders')</option>
                @foreach (config('orderStatus') as $orderStatus)
                <option value="{{ $orderStatus }}" "@if ($orderStatus == $status) selected @endif">
                    @lang('site.order_status_'
                    . $orderStatus)</option>
                @endforeach
            </select>
        </div>
        <!-- end of status  -->
        <!-- start of searche  -->
        <div class="col-8 col-sm-5 col-md-5">
            <div class="input-group input-group-sm">
                <input type="text" name="search" value="" placeholder="@lang('site.search_placeholder')"
                    class="form-control">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
        <!-- end of searche  -->
        <!-- start of view setting panel  -->
        <div class="col-4 col-sm-2 col-md-2">
            <div class="float-right">
                <a href="{{ url('order/show-view-setting') }}" class="btn btn-sm btn-info showViewSetting">
                    <i class="fas fa-cog"></i>
                </a>
            </div>
        </div>
        <!-- end of view setting panel  -->
    </div>
</form>
