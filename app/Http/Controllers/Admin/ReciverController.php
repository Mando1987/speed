<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\ReciverRepositoryInterface;
use App\Http\Requests\ReciverFormRequest;
use App\Models\Reciver;

class ReciverController extends Controller
{

    private $reciverRepositoryInterface;
    public function __construct(ReciverRepositoryInterface $reciverRepositoryInterface)
    {
       $this->reciverRepositoryInterface = $reciverRepositoryInterface;
    }
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(ReciverFormRequest $request, $id)
    {
      return $this->reciverRepositoryInterface->update($request, $id);
    }

    public function destroy($id)
    {
        //
    }
}
