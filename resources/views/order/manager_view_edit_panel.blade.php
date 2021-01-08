<!-- edit  Box -->
<div class="card card-primary card-outline pt-4 mb-0">
    <div class="card-body text-center d-flex flex-column">

        <div>
            <x-button
                :route="route('order.edit_order',['edit_type' => 'edit_customer', 'order_id' => $request->order_id])"
                class="btn-info  mb-1" text="site.order_edit_customer" />
        </div>
        <div>
            <x-button
                :route="route('order.edit_order',['edit_type' => 'edit_reciver', 'order_id' => $request->order_id])"
                class="btn-primary mb-1" text="site.order_edit_reciver" />
        </div>
        <div>
            <x-button :route="route('order.edit_order',['edit_type' => 'edit_order', 'order_id' => $request->order_id])"
                class="btn-danger " text="site.order_edit_order" />
        </div>
        <hr>
        <div>
            <x-button :route="route('order.update_order',['order_id' => $request->order_id])"
                class="btn-secondary showUpdatePanel mt-2" text="site.order_update_order" />
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button class="btn btn-danger float-right" onclick="Swal.close()">@lang('site.cancel')</button>
    </div>
</div>
<!-- /.card -->
