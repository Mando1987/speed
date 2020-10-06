<?php

namespace App\Repositories;

class OrderFormRequestByManagerRepository implements OrderFormRequestInterface

{
    public function rules()
    {
        return [];
    }
    public function validated()
    {
        return 123456789;
    }
}
