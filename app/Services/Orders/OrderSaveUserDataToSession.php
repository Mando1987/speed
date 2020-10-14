<?php

namespace App\Services\Orders;

use Illuminate\Http\Request;

class OrderSaveUserDataToSession
{
    public $page;

    public $data = [
        'fullname' => '',
        'phone' => '',
        'other_phone' => '',
        'governorate_id' => 1,
        'city_id' => 1,
        'page' => '',
        'address' => '',
        'existingId' => '',
        'chooseType' => '',
        'adminType' => '',
        'adminId' => '',

    ];
    public $fackerData = [
        'fullname' => '',
        'phone' => '',
        'other_phone' => '',
        'governorate_id' => 1,
        'city_id' => 1,
        'page' => '',
        'address' => '',
        'special_marque' => '',
        'house_number' => '',
        'door_number' => '',
        'shaka_number' => '',
        'existingId' => 1,
        'chooseType' => 'exists',
        'adminType' => '',
        'adminId' => '',
    ];
    public $addressData = [
        'address' => '',
        'special_marque' => '',
        'house_number' => '',
        'door_number' => '',
        'shaka_number' => '',
    ];

    private $customer;
    private $reciver;
    private $adminType;

    public function handle(Request $request)
    {
        $this->page = $request->page ?? 1;
        $this->customer = session('customer');
        $this->reciver = session('reciver');
        $this->customerAddress = session('customerAddress');
        $this->reciverAddress = session('reciverAddress');
        $this->fackerData['chooseType'] = session('chooseType') ?? 'exists';
        $this->adminType = $request->adminType;
        $this->adminId = $request->adminId;

        if ($request->adminType == 'manager') {
            $this->redirctToCustomerForm();
            $this->redirctToReciverForm();
        } else {
            $this->customerRedirctToReciverForm();
        }
        session(['page' => $this->page]);
        return ($this->data['adminType'] == $this->adminType)? (object) $this->data : $this->orderData();

    }

    private function redirctToCustomerForm()
    {
        if ($this->page == 1 || ($this->page == 2 && !$this->customer) || ($this->page == 3 && !$this->customer && !$this->reciver)) {
            $this->page = 1;
            $this->setData($this->customer, $this->customerAddress);
        }

    }

    private function redirctToReciverForm()
    {
        if ($this->page == 2 || ($this->page == 3 && $this->customer && !$this->reciver)) {
            $this->page = 2;
            $this->setData($this->reciver, $this->reciverAddress);
        }
    }
    private function customerRedirctToReciverForm()
    {
        if ($this->page == 1 || ($this->page == 2 && !$this->reciver)) {
            $this->page = 1;
            $this->setData($this->reciver, $this->reciverAddress);
        }
    }

    private function setData($userData, $address)
    {
        $data = (is_array($userData)) ? $userData : $this->fackerData;

        foreach ($data as $key => $val) {
            if (array_key_exists($key, $this->data)) {
                $this->data[$key] = $val;
            }
        }
        $this->data['page'] = $this->page;
        $this->data['adminType'] = $this->adminType;
        $this->data['adminId'] = $this->adminId;
        $this->data['address'] = $this->fillAddressData($address ?? $data);

    }

    public function fillAddressData($data)
    {
        foreach ($data as $key => $val) {
            if (array_key_exists($key, $this->addressData)) {
                $this->addressData[$key] = $val;
            }
        }
        return (object) $this->addressData;
    }
    public function orderData()
    {
        return (object) ['adminType' => $this->adminType];
    }
}
