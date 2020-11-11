<?php
namespace App\Http\Interfaces;

use App\Http\Requests\CustomerFormRequest;

interface CustomerRepositoryInterface
{
    public function updateByOrder(CustomerFormRequest $request, $id);
}
