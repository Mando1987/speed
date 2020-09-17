<?php

namespace App\Services\Delegates;

use App\Models\Delegate;
use App\Services\BaseService;


class DelegateFetshDataService extends BaseService
{
    const IMAGE_PATH = 'delegates/';

    private $delegate;
    public function __construct(Delegate $delegate)
    {

        $this->delegate = $delegate;
    }

    public function index()
    {
        $delegates = $this->delegate::with('delegateDrive')->paginate(self::PAGINATE_NUM);
        return view('delegate.index', [
            'delegates' => $delegates
        ]);
    }
}
