<?php
namespace App\Http\Traits;

use App\Http\Repositories\ViewSettingRepository;

trait ViewSettingTrait
{
    private $paginate ;
    private $view ;

    private function setViewSetting(): void
    {
        $viewSetting = ViewSettingRepository::viewSetting(request());
        $this->view = $viewSetting['view_mode'];
        $this->paginate = $viewSetting['paginate'];
    }
}

