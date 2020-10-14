<?php

return [
    'App\Interfaces\OrderStoreFormRequestInterface' => [
        'manager' => 'App\Http\Requests\OrderStoreFormRequestByManager',
        'customer' => 'App\Http\Requests\OrderStoreFormRequestByCustomer',
    ],
];
