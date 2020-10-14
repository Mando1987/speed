<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class LanguageComposer
{
    private $languages;

    public function compose(View $view)
    {
        if(!$this->languages){
            $this->languages = config('languages');
        }

        return $view->with('languages', $this->languages)
        ->with('defaultLang', $this->languages[app()->getLocale()]);
    }
}