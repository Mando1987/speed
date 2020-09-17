<?php

return [

    'action'             => 'خيارات',
    'admin_columns'      =>
    [
        'name'           => 'اسم المستخدم',
        'fullname'       => 'الأسم بالكامل',
        'parent_id'      => 'الأدمن الرئيسى',
        'role_id'        => 'الصلاحيات',
        'active'         => 'متاح',
    ],
    'order' => [
        'customer'       => 'العميل',
        'created_at'     => 'التاريخ',
        'city'           => 'المنطقة',
        'total_price'    => 'إجمالى الشحنة',
        'status'         => 'الحاله',
        'delegate'       => 'المندوب',
        //'type'         => 'نوع الشحن',
       // 'price'        => 'قيمة الشحنة',
       // 'charge_price' => 'تكاليف الشحن',
        'order_num'      => 'رقم البوليصه',

    ]

];
