<?php
namespace App\Http\Repositories;

use App\Models\Reciver;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReciverFormRequest;
use App\Http\Interfaces\ReciverRepositoryInterface;

class ReciverRepository implements ReciverRepositoryInterface
{

    public function update(ReciverFormRequest $request, $id)
    {
        $reciver = Reciver::find($id);
        if ($reciver) {
            if ($request->adminIsCustomer) {
                if ($reciver->customer->id !== $request->adminId) {
                    return $this->responsejson(trans('site.edit_reciver_not_for_curent_customer'));
                }
            }
            try {
                DB::beginTransaction();
                $reciver->update($request->validated()['reciver']);
                $reciver->address()->update($request->validated()['address']);

                DB::commit();

            } catch (\Exception $ex) {

            }
        }
        return $this->responsejson(trans('site.edit_reciver_not_found_' . $request->adminType));
    }
}
