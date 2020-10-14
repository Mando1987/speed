<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait IdentifyTrait
{
    public function identify($request)
    {
        $className = get_called_class() . 'By' . Str::ucfirst($request->adminType);
        return  class_exists($className) ? (new $className) : abort(404);
    }


}
