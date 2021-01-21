<?php

return [

    'action'             => 'خيارات',
    'admin_columns'      => [
        'name'           => 'اسم المستخدم',
        'fullname'       => 'الأسم بالكامل',
        'parent_id'      => 'الأدمن الرئيسى',
        'role_id'        => 'الصلاحيات',
        'active'         => 'متاح',
    ], 'order'           => [
        'customer'       => [
            'reciver'    => ' العميل',
            'created_at' => 'التاريخ',
            'city'       => 'المنطقة',
            'phone'      => 'التليفون',
            'total_price'=> 'إجمالى الشحنة',
            'status'     => 'الحاله',
            'order_num'  => 'رقم البوليصه',

        ],
        'manager'        => [
            'customer'   => 'العميل',
            'created_at' => 'التاريخ',
            'city'       => 'المنطقة',
            'phone'      => 'التليفون',
            'reciver'    => 'المرسل اليه',
            'total_price'=> 'إجمالى الشحنة',
            'status'     => 'الحاله',
            'order_num'  => 'رقم البوليصه',

        ],
        'delegate'       => [
            'customer'   => 'العميل',
            'city'       => 'المنطقة',
            'phone'      => 'التليفون',
            'order_num'  => 'رقم البوليصه',
        ],
    ], 'delegate'        => [
        'fullname'       => 'الأسم ',
        'qualification'  => 'المؤهل',
        'phone'          => 'رقم التليفون',
        // 'national_id'        => 'الرقم القومى',
        'driveType'      => 'نوع المركبه',
        'driveColor'     => 'لون المركبه',
        'drivePlate_number' => 'رقم اللوحه',
        'delegate_active'   => 'حالة المندوب',
    ],
    'customer'         => [
        'manager'      => [
            'fullname' => 'الأسم بالكامل',
            'phone'    => 'التليفون',
            'city'     => 'المنطقه',
            'address'  => 'العنوان',
            'company_name' => 'اسم الشركه',
            'activity'     => 'النشاط',
        ],

    ], 'place'              => [
        'governorate_name'  => 'اسم المحافظه',
        'city_name'         => 'اسم المدينه',
    ],
    'prices'                => [
        'city'              => 'المدينة',
        'price_send_weight' => 'حتى وزن',
        'price_send_price'  => 'سعر التوصيل',
        'price_weight_addtion' => 'الوزن الإضافى',
        'price_price_addtion'  => 'السعر الإضافى',
    ],

];
