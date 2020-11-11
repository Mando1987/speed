<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Http\Requests\CustomerFormRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{

    public function updateByOrder(CustomerFormRequest $request, $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            try {
                DB::beginTransaction();
                $customer->update($request->validated()['customer']);
                $customer->address()->update($request->validated()['address']);

                DB::commit();
                $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_EDITED]);

                return $this->responseJson('ok', 200, route('order.index'));

            } catch (\Exception $ex) {
                DB::rollback();
                return $this->responsejson($ex->getMessage());
            }
        }
        return $this->responsejson(trans('site.edit_reciver_not_found_customer'));
    }
}
