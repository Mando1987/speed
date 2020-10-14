<?php
namespace App\Http\Interfaces;

interface OrderStoreFormRequestInterface
{
    public function rules();
    public function validated();
}
