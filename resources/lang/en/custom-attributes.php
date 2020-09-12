<?php
/**
 * هنا اسم العمود اللى هيظهر للعميل لو فيه خطأ ف الادخال
 * مثال : اسم المستخدم مطلوب
 */
return [
    'admin' => [
        'user_name'                   => 'Username',
        'password'                    => 'Password',
        'password_confirmation'       => 'confirm password',
        'fullname'                    => 'Full Name',
        'email'                       => 'E-mail',
        'phone'                       => 'phone Number',
        'other_phone'                 => 'Another phone Number',
        'address'                     => 'Address',
        'contract_type'               => 'Contract Type',
        'activity'                    => 'Activity',
        'special_marque'              => 'special Marque',
        'house_number'                => 'House Number',
        'door_number'                 => 'Role Number',
        'shaka_number'                => 'Apartment Number',
        'company_name'                => 'Company Name',
        'facebook_page'               => 'Link Facebook page',
    ],
    'role' => [
        'name'                        => 'Group Name'
    ],
    ,
    'prices'=>[
        'send_weight'                 => 'Even weight',
        'send_price'                  => 'Delivery price',
        'weight_addtion'              => 'Extra weight',
        'price_addtion'               => 'Extra price',
    ],
    'order' =>  [
        'sender.fullname'             => 'customer Name',
        'sender.phone'                => 'phone Number',
        'sender.other_phone'          => 'Another phone Number',
        'sender.address'              => 'Address',
        'sender.special_marque'       => 'Distinctive sign',
        'sender.house_number'         => 'House or property Number',
        'sender.door_number'          => 'Role Number',
        'sender.shaka_number'         => 'Apartment Number',

        'reciver.fullname'            => 'The sender\'s name',
        'reciver.phone'               => 'phone Number',
        'reciver.other_phone'         => 'Another phone Number',
        'reciver.address'             => 'Address',
        'reciver.special_marque'      => 'Distinctive sign',
        'reciver.house_number'        => 'House or property Number',
        'reciver.door_number'         => 'Role Number',
        'reciver.shaka_number'        => 'Apartment Number',

        'order.order_info'            => 'Description shipment',
        'order.order_weight'          => 'Shipment weight',
        'order.order_quantity'        => 'Number of products',
        'order.order_price'           => 'The value of the shipment',
        'order.order_charge_price'    => 'Shipping costs',
        'order.order_total_price'     => 'Total shipment',
    ],
];
