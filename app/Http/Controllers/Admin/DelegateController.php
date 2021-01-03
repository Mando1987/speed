<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\DelegateRepositoryInterface;
use App\Http\Requests\DelegateStoreFormRequest;
use App\Http\Requests\DelegateUpdateFormRequest;
use App\Services\Delegates\DelegateEditUpdateService;
use App\Services\Delegates\DelegateFetshDataService;

class DelegateController extends Controller
{
    private $delegateRepository;

    public function __construct(DelegateRepositoryInterface $delegateRepository)
    {
        $this->delegateRepository = $delegateRepository;
    }
    public function index()
    {
        return app(DelegateFetshDataService::class)->index();
    }
    public function show($id)
    {
        return app(DelegateFetshDataService::class)->show($id);
    }
    public function create()
    {
        return $this->delegateRepository->create();
    }

    public function store(DelegateStoreFormRequest $request)
    {
       return $this->delegateRepository->store($request);

        //    return $client->upload('/back/ann.jpeg',$request->file('image')->getPath());
        // dd($request->validated());

        // upload file to dropbox and return url ;
        // $filePath =  \Storage::disk('dropbox')->putFile( '/back', $request->validated()['image']);/
        // $url = \Storage::disk('dropbox')->url($filePath);
        //upload file to google and return url ;
        // $filePath = \Storage::disk('google')->putFile('', $request->validated()['image']);
        // return \Storage::disk('google')->url($filePath);
        // return $url;
        //  return \Storage::disk('dropbox')->get();
        // $url =  \Storage::disk('dropbox')->url($appfile);
        // \Storage::disk('dropbox')->listFolder();
        // return app(DelegateCreateStoreService::class)->store($request);

        /***
         * delete all files in folder
         */
        // $files=  \Storage::disk('dropbox')->files();
        //return  \Storage::disk('dropbox')->delete($files);
        // end delete
        // return  \Storage::disk('dropbox')->deleteDirectory('back');
        // $files=  \Storage::disk('google')->files();
        // return \Storage::disk('google')->delete($files);
        // get file from dropbox and put this in local
        // $filePath =  \Storage::disk('dropbox')->get('2020-12-28-16-04-14.zip');
        // return \Storage::disk('local')->put( 'new.zip', $filePath);

    }

    public function edit($id)
    {
        return app(DelegateEditUpdateService::class)->edit($id);
    }

    public function update(DelegateUpdateFormRequest $request, $id)
    {
        return app(DelegateEditUpdateService::class)->update($request, $id);
    }

    public function changeActive($id)
    {
        return app(DelegateEditUpdateService::class)->changeActive($id);
    }
}
