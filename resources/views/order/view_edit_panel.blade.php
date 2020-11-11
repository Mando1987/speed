<div class="card card-primary card-outline">

    <div class="card-body box-profile">
        <p class="text-muted text-center font-weight-bold">@lang('site.order_edit_title')</p>
        <ul class="list-group list-group-unbordered mb-2">
            @if($request->adminIsCustomer)
            <li class="list-group-item">
                <x-button :route="route('order.edit_order',['edit_type' => 'edit_reciver', 'order_id' => $request->order_id])"
                    class="btn-info btn-block showInOpenModal" text="site.order_edit_customer" />
            </li>
            @endif
            @if($request->adminIsManager)
            <li class="list-group-item">
                <x-button :route="route('order.edit_order',['edit_type' => 'edit_customer', 'order_id' => $request->order_id])"
                    class="btn-info btn-block showInOpenModal" text="site.order_edit_customer" />
            </li>
            <li class="list-group-item">
                <x-button :route="route('order.edit_order',['edit_type' => 'edit_reciver', 'order_id' => $request->order_id])"
                    class="btn-block btn-primary showInOpenModal" text="site.order_edit_reciver" />
            </li>
            @endif
            <li class="list-group-item">
                <x-button :route="route('order.edit_order',['edit_type' => 'edit_order', 'order_id' => $request->order_id])"
                    class="btn-block btn-danger showInOpenModal" text="site.order_edit_order" />
            </li>
        </ul>
        <p class="text-center font-weight-bold">@lang('site.order_edit_delegate_title')</p>
        <ul class="list-group list-group-unbordered mb-2">
            <li class="list-group-item">
                <x-button class="btn-info btn-block" text="site.order_edit_customer" />
            </li>
            <li class="list-group-item">
                <x-button class="btn-block btn-primary" text="site.order_edit_reciver" />
            </li>
            <li class="list-group-item">
                <x-button class="btn-block btn-danger" text="site.order_edit_order" />
            </li>
        </ul>

    </div>

    <div class="card-footer">
        <button class="btn btn-primary" data-dismiss="modal">@lang('site.cancel')</button>
    </div>
    <!-- /.card-body -->
</div>