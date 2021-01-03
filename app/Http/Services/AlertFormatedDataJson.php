<?php
namespace App\Http\Services;

class AlertFormatedDataJson
{

    private $alertBodyData = [];
    private $data = [];
    private $target;

    public function  __construct(string $target)
    {
       $this->target = $target;
    }
    public function alertBody(string $viewName , string $message = '', string $icon = 'success', string  $title ='')
    {
        $this->alertBodyData = [
                'icon' => $icon,
                'title' => $title,
                'html' => view( $viewName, ['message' => $message])->toHtml(),
        ];
        return $this;
    }
    public function dataContent(array $data)
    {
        $this->data = $data;
        return $this;
    }
    public function formatedData()
    {
       return response()->json(
          [
              'target' => $this->target,
              'alert' => $this->alertBodyData,
              'data' => $this->data,
          ]
       );
    }

    public static function alertServerError(string $routeName)
    {
       return response()->json(
          [
              'target' => 'serverError',
              'alert' => [
                  'icon' => 'error',
                  'html' => view('includes.alerts.server_error' ,['routeName' => $routeName])->toHtml(),
              ]
          ],
          500
       );
    }



}