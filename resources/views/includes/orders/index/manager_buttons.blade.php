<x-button :route="route('order.show', $order->id)" type="view" class="showSingleModel" />
<x-button :route="route('order.view_Edit_Panel', ['order_id' => $order->id])" type="edit" class="showEditPanel" />
<x-button :route="route('order.view_Delete_Daialog', $order->id)" type="delete" class="showSingleModel" />
<x-button :route="route('order.print' ,['orderId' =>$order->id])" type="print" class="print" />
