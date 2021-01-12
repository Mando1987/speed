<x-button :route="route('order.update_order',['order_id' => $order->id])" :text="__('site.order_update')"
    type="edit" class="showUpdatePanel" />
