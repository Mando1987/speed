<?php

return [

    'action'            => 'Options',
    'admin_columns'     => [
    'name'              => 'Username',
    'fullname'          => 'Full Name',
    'parent_id'         => 'The main Aladinm',
    'role_id'           => 'Permissions',
    'active'            => 'Available',
    ], 'order'          => [
    'customer'          => [
    'reciver'           => 'Client',
    'created_at'        => 'Date',
    'city'              => 'Region',
    'phone'             => 'Phone',
    'total_price'       => 'Total shipment',
    'status'            => 'Status',
  //'type'              => 'Shipping type',
 // 'price'             => 'The value of the shipment',
 // 'charge_price'      => 'Shipping costs',
    'order_num'         => 'Policy Number',

    ],
    'manager' => [
    'customer'          => 'Client',
    'created_at'        => 'Date',
    'city'              => 'Region',
    'total_price'       => 'Total shipment',
    'status'            => 'Status',
    'delegate'          => 'Delegate',
  //'type'              => 'Shipping type',
 // 'price'             => 'The value of the shipment',
 // 'charge_price'      => 'Shipping costs',
    'order_num'         => 'Policy number',

        ]
    ], 'delegate'       => [
    'fullname'          => 'Name',
    'qualification'     => 'qualification',
    'phone'             => 'phone number',
 // 'national_id'       => 'National ID',
    'driveType'         => 'Vehicle type',
    'driveColor'        => 'Vehicle color',
    'drivePlate_number' => 'Plate Number',
    'delegate_active'   => 'Delegate status',
    ],
    'customer'                  => [
        'manager'               => [
            'fullname'          => 'Full Name',
            'phone'             => 'Phone',
            'city'              => 'Zone',
            'address'           => 'Address',
            'company_name'      => 'The Company\'s Name',
            'activity'          => 'Activity',
        ]

        ],'place' => [
            'governorate_name'  => 'Governorate Name',
            'city_name'         => 'city Name',
        ]
];
