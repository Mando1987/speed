<?php

namespace App\Repositories;

use Illuminate\Support\Str;

class ClassBindRepository
{
    private $type;

    public function bind($interface)
    {
        $identify      = auth('admin')->user();
        $this->type    = $identify->type;
        $type          = $this->type;
        //dd($identify);


        $className = Str::replaceFirst('Interface', '', $interface);
        $className = 'App\\Repositories\\'. $className .'By'.Str::ucfirst($type) . 'Repository';

        return app()->bind(OrderFormRequestInterface::class , $className);

    }
}
