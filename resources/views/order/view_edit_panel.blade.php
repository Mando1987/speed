<div class="card card-primary card-outline">

    <div class="card-body box-profile">
        <p class="text-muted text-center font-weight-bold">@lang('site.order_edit_title')</p>
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item justify-content-between text-center">
                @if($request->adminIsCustomer)
                <x-button
                    :route="route('order.edit_order',['edit_type' => 'edit_reciver', 'order_id' => $request->order_id])"
                    class="btn-info" text="site.order_edit_customer" />
                @endif
                @if($request->adminIsManager)
                <x-button
                    :route="route('order.edit_order',['edit_type' => 'edit_customer', 'order_id' => $request->order_id])"
                    class="btn-info" text="site.order_edit_customer" />
                <x-button
                    :route="route('order.edit_order',['edit_type' => 'edit_reciver', 'order_id' => $request->order_id])"
                    class="btn-primary" text="site.order_edit_reciver" />
                @endif
                <x-button
                    :route="route('order.edit_order',['edit_type' => 'edit_order', 'order_id' => $request->order_id])"
                    class="btn-danger" text="site.order_edit_order" />
            </li>
        </ul>
        {{-- <p class="text-center font-weight-bold">@lang('site.order_edit_delegate_title')</p>
        <ul class="list-group list-group-unbordered mb-2">
            <li class="list-group-item">
                <x-button class="btn-info " text="site.order_edit_customer" />
                <x-button class=" btn-primary" text="site.order_edit_reciver" />
                <x-button class=" btn-danger" text="site.order_edit_order" />
            </li>
        </ul> --}}

    </div>

    <div class="card-footer">
        <button class="btn btn-primary" data-dismiss="modal">@lang('site.cancel')</button>
    </div>
    <!-- /.card-body -->
</div>