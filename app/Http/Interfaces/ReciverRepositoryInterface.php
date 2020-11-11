<?php
namespace App\Http\Interfaces;

use App\Http\Requests\ReciverFormRequest;

interface ReciverRepositoryInterface
{
    public function update(ReciverFormRequest $request, $id);
}
