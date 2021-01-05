<div class="col-12 col-sm-6 col-md-4  d-flex align-items-stretch">
    <div class="card bg-light w-100 card-outline card-info">
        <div class="card-body pt-0 mb-0 pb-1 p-0">
            <table class="table text-nowrap align-items-stretch table-sm">
                <tbody>
                    <tr>
                        <td class="border-top-0">@lang('datatable.prices.city')</td>
                        <td class="border-top-0 font-weight-bold text-muted">
                            {{ $price->city->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0">@lang('datatable.prices.price_send_weight')</td>
                        <td class="border-top-0 font-weight-bold text-muted">
                            {{ $price->send_weight }} @lang('site.price_weight')
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0">@lang('datatable.prices.price_send_price')</td>
                        <td class="border-top-0 font-weight-bold text-muted">
                            {{ $price->send_price }} @lang('site.price_bound')
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0">@lang('datatable.prices.price_weight_addtion')</td>
                        <td class="border-top-0 font-weight-bold text-muted">
                            {{ $price->weight_addtion }} @lang('site.price_weight')
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0">@lang('datatable.prices.price_price_addtion')</td>
                        <td class="border-top-0 font-weight-bold text-muted">
                            {{ $price->price_addtion }} @lang('site.price_bound')
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-3 mb-0">
                <x-button :route="route('price.edit', $price->id)" type="edit" />
                <x-button :route="route('price.destroy', $price->id)" type="delete" class="showSingleModel" />
            </div>
        </div>
    </div><!-- end of card-->
</div>
