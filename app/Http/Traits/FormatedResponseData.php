<?php
namespace App\Http\Traits;

trait FormatedResponseData
{
    /**
     * format returned data
     * @param string $target => createOrder in camelCase
     * @param array $data => [any data]
     * @param array $alert => must be ['title' => '','icon'=> '','html']
     * @return array
     */
    protected function formatData(string $target, array $data = [], array $alert = []) :array
    {
        return [
            'target' => $target,
            'data' => $data ?? null,
            'alert' => $alert ?? null,
        ];
    }

}
