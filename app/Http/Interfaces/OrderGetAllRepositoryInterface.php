<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface OrderGetAllRepositoryInterface
{
    public function getAll(Request $request);
}
