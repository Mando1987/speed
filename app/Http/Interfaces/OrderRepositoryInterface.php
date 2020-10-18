<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use App\Http\Interfaces\OrderStoreFormRequestInterface;

interface OrderRepositoryInterface
{
    public function getAll(Request $request);
    public function showById(Request $request, $id);
    public function create();
    public function store(OrderStoreFormRequestInterface $request);
    public function update();
    public function print(Request $request);
}
