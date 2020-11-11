<?php
namespace App\Http\Repositories;

use App\Models\Reciver;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReciverFormRequest;
use App\Http\Interfaces\ReciverRepositoryInterface;

class ReciverRepository extends BaseRepository implements ReciverRepositoryInterface
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
                $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_EDITED]);

                return $this->responseJson('ok',200 , route('order.index'));

            } catch (\Exception $ex) {
                DB::rollback();
                return $this->responsejson($ex->getMessage());
            }
        }
        return $this->responsejson(trans('site.edit_reciver_not_found_' . $request->adminType));
    }
}
