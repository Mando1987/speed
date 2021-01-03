<?php
namespace App\Http\Repositories\Customers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\UploadImageTrait;
use App\Http\Traits\FormatedResponseData;
use App\Http\Requests\CustomerFormRequest;
use App\Http\Services\AlertFormatedDataJson;
use App\Http\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    use UploadImageTrait, FormatedResponseData;
    const IMAGE_PATH = 'customers/profile/';

    private $admin;
    public $route = 'customer.index';

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
    public function updateByOrder(CustomerFormRequest $request, $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            try {
                DB::beginTransaction();
                $customer->update($request->validated()['customer']);
                $customer->address()->update($request->validated()['address']);

                DB::commit();

                //return $this->responseJson('ok', 200, route('order.index'));

            } catch (\Exception $ex) {
                DB::rollback();
                //return $this->responsejson($ex->getMessage());
            }
        }
        //return $this->responsejson(trans('site.edit_reciver_not_found_customer'));
    }
    public function create()
    {
        return view('customer.create');
    }
    public function store($request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            $newAdmin = $this->admin->create($data['admin']);
            $newCustomer = $newAdmin->customer()->create(
                array_merge($data['customer'], [
                    'image' => $this->handeImageUploadUsingIntervention($data['image'], self::IMAGE_PATH),
                    'phone' => $data['admin']['phone'],
                    'other_phone' => $data['admin']['other_phone'],
                ])
            );
            $newCustomer->address()->create($data['address']);
            DB::commit();
            return (new AlertFormatedDataJson('validateCustomer'))->alertBody(
                   'includes.alerts.customer',
                   trans('site.added')
                )->formatedData();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertServerError('customer.create');
        }
    }
    public function edit($customer)
    {
        return view('customer.edit', [
            'data' => [
                'customer' => $customer,
                'admin' => $customer->admin,
                'address' => $customer->address,
            ],
        ]);
    }
    public function update($request, $customer)
    {
        try {
            DB::beginTransaction();
            $customer->admin()->update($request->validated()['admin']);
            $customer->update(
                array_merge($request->validated()['customer'], [
                    'image' => $this->handeImageUploadUsingIntervention($request->validated()['image'], self::IMAGE_PATH),
                ])
            );
            $customer->address()->update($request->validated()['address']);
            DB::commit();

        } catch (\Exception $ex) {

            DB::rollback();
            dd($ex->getMessage());
            return back();
        }
    }

}
