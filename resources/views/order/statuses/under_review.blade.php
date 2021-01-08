<div class="card card-outline card-purple mb-0">
    <div class="card-body">

        <div class="row">
            <div class="col-12 text-center">
                <strong class="badge bg-light p-md-3 p-2 mb-3">
                    {{__('site.order_change_status')}}
                </strong>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <x-button class="btn-success p-2 changeOrderStatus" type="edit"
                 text="site.order_under_preparation_change"
                 :route="route('order.change_status',['orderId' => $orderId , 'status' => 'under_preparation','step' => 'step1'])"
                 />
                <x-button class="btn-danger p-2 ml-3" type="delete" text="site.order_cancelled_change" />
            </div>
        </div>

    </div><!-- end of card-body -->
    <div class="card-footer">
        <button class="btn btn-danger float-right" onclick="Swal.close()">@lang('site.cancel')</button>
    </div>
</div><!-- end of card-->
