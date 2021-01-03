<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface DelegateRepositoryInterface
{
    public function create();
    public function store(Request $request);

    // public function showById(Request $request, $id);
}
