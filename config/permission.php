<?php 

/**
 * permission table
 * 
 *  tag => admin , name => admin_index
 *  tag => admin , name => admin_create
*/
return [
     'tags' =>[
        'admin' =>['dashboard' , 'admin' ,'role'],
     ],
    'all' =>[
        
        'admin' => [
            'dashboard' => [ 'index' ],
            'admin'    => [ 'index' , 'create' , 'edit' , 'show' , 'destroy'],
            'role'     => [ 'index' , 'create' , 'edit' , 'show' , 'destroy'],
        ],
        'manager' => [
            'package'  => [ 'index' , 'create' , 'edit' , 'show' , 'destroy'],
        ]
    ]
];
