<?php
namespace App\Http\Traits;

trait ViewSettingTrait
{
    private $paginate = 10;
    private $view = 'list';

    private function setViewSetting(): void
    {
        $viewSetting = session('orderViewSetting');
        $this->view = $viewSetting['view_mode'] ?? $this->view;
        $this->paginate = $viewSetting['paginate'] ?? $this->paginate;
    }
}

