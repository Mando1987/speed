<div class="col-md-6">
    <!-- edit  Box -->
    <div class="card card-primary card-outline">

        <div class="card-body text-center">
            <x-button
                :route="route('order.edit_order',['edit_type' => 'edit_reciver', 'order_id' => $request->order_id])"
                class="btn-info" text="site.order_edit_customer" />
            <hr>
            <x-button :route="route('order.edit_order',['edit_type' => 'edit_order', 'order_id' => $request->order_id])"
                class="btn-danger btn-block" text="site.order_edit_order" />
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button class="btn btn-primary" data-dismiss="modal">@lang('site.cancel')</button>
        </div>
    </div>
    <!-- /.card -->
</div>
