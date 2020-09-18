<?php

namespace App\Services\Delegates;

use App\Services\BaseService;


class DelegateSaveUserInputDataService extends BaseService
{

    public function __construct($data)
    {
        $data = is_object($data) ? (array) $data : $data;
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->$key = old($key)?? $value;
            }
        }
    }
}
