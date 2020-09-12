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
        'name'            => 'Group Name'
    ],
    ,
    'prices'=>[
        'send_weight'           => 'حتى وزن',
        'send_price'            => 'سعر التوصيل',
        'weight_addtion'        => 'الوزن الاضافى',
        'price_addtion'         => 'السعر الاضافى',
    ],
    'order' =>  [
        'sender.fullname'                    => 'اسم العميل',
        'sender.phone'                       => 'رقم التليفون',
        'sender.other_phone'                 => 'رقم تليفون إضافى',
        'sender.address'                     => 'العنوان',
        'sender.special_marque'              => 'علامة مميزة',
        'sender.house_number'                => 'رقم البيت او العقار',
        'sender.door_number'                 => 'رقم الدور',
        'sender.shaka_number'                => 'رقم الشقة',

        'reciver.fullname'                    => 'اسم المرسل اليه',
        'reciver.phone'                       => 'رقم التليفون',
        'reciver.other_phone'                 => 'رقم تليفون إضافى',
        'reciver.address'                     => 'العنوان',
        'reciver.special_marque'              => 'علامة مميزة',
        'reciver.house_number'                => 'رقم البيت او العقار',
        'reciver.door_number'                 => 'رقم الدور',
        'reciver.shaka_number'                => 'رقم الشقة',

        'order.order_info'         => 'وصف الشحنة',
        'order.order_weight'       => 'وزن الشحنة',
        'order.order_quantity'     => 'عدد المنتجات',
        'order.order_price'        => 'قيمة الشحنة',
        'order.order_charge_price' => 'تكاليف الشحن',
        'order.order_total_price'  => 'اجمالى الشحنة',
    ],
];
