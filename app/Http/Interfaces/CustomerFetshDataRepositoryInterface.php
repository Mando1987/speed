<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface CustomerFetshDataRepositoryInterface
{
    public function getAll(Request $request);
}
