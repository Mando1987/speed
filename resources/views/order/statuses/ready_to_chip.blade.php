<form class="orderIndexForm" method="POST" action="{{ route('order.Receipt_from_customer', $orderId) }}">
    <div class="card card-outline card-purple mb-0">
        <div class="card-body">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-12 text-center">
                    <strong class="badge bg-light p-md-3 p-2 mb-3">
                        {{__('site.Delivery_to_the_customer')}}
                    </strong>
                </div>
            </div> <!-- end of row-->
            <div class="row mt-1">
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.Receipt_order_status')}}" />
                        </div>
                        <div class="col-sm-8">
                            <select class="custom-select" name="ReceiptProssess">
                                <option value="done">
                                    @lang('site.Delivery_to_the_customer_done')
                                </option>
                                <option value="cancelled">
                                    @lang('site.Delivery_to_the_customer_failed')
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- end of row-->
            <div class="row mt-1">
                <div class="col-md">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <x-label title="{{__('site.Delivery_cancelled_reason')}}" />
                        </div>
                        <div class="col-sm-8">
                            <select class="custom-select" name="cancelledReason">
                                <option value="ADDRESS_WRONG">
                                    @lang('site.Delivery_cancelled_reason_address_wrong')
                                </option>
                                <option value="ADDRESS_NEW">
                                    @lang('site.Delivery_cancelled_reason_customer_address_new')
                                </option>
                                <option value="CUSTOMER_NOT_FOUND">
                                    @lang('site.Delivery_cancelled_reason_customer_not_found')
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- end of row-->
        </div><!-- end of card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-danger float-right ml-2" onclick="Swal.close()">@lang('site.cancel')</button>
            <button type="submit" class="btn btn-success float-right">@lang('site.save')</button>
        </div>
    </div><!-- end of card-->
</form>


