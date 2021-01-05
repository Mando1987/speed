<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface PlacePricesRepositoryInterface
{
   public function getAll(Request $request);
   public function create($showInModel);
   public function store(Request $request);
   public function edit($id);
   public function update(Request $request,$id);
   // public function destroy();
}
