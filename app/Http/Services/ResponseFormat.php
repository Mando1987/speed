<?php
namespace App\Http\Services;

class ResponseFormat
{
    /**
     * set to target page ex : createOrder must be in camleCase
     * @var string
     */
    private $target;
    /**
     * set data to return to ajax
     * @var array
     */
    private $data = [];
    /**
     * set alert box property : title , icon , html body
     *
     * @var array
     */
    private $alert = [];
    /**
     * @param string $target ex : createOrder
     * @param array $data ex : ['showClass' => 'reciver']
     * @param array $alert ex : ['title' => 'done', 'icon' => 'success', 'html' => '<h1>h1</>']
     */
    public function __construct(string $target, array $data, array $alert = [])
    {
        $this->data = $data;
        $this->target = $target;
    }

    public function getData() :array
    {
        return [
            'target' => $this->target,
            'data' => $this->data ?? null,
            'alert' => $this->alert ?? null,
        ];
    }



}
