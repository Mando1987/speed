<?php

namespace App\Services\Orders;

class Address
{

  public  $address;
  public  $special_marque;
  public  $house_number;
  public  $door_number;
  public  $shaka_number;

  public function __construct($data)
  {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key))
        $this->$key = $value;
    }
  }
}

class OrderSaveUserDataToSession
{
  const SESSION_CUSTOMER  = 'customer';
  const SESSION_RECIVER   = 'reciver';
  const SESSION_ADDRESS   = 'address';
  const SESSION_PAGE      = 'page';

  public  $page;

  public $data = [
    'fullname'       => '',
    'phone'          => '',
    'other_phone'    => '',
    'governorate_id' => 1,
    'city_id'        => 1,
    'page'           => '',
    'address'        => ''

  ];
  public $fackerData = [
    'fullname'       => '',
    'phone'          => '',
    'other_phone'    => '',
    'governorate_id' => 1,
    'city_id'        => 1,
    'page'           => '',
    'address'        => '',
    'special_marque' => '',
    'house_number'   => '',
    'door_number'    => '',
    'shaka_number'   => '',

  ];

  private $customer;
  private $reciver;
  private $address;

  public function handle($page = null)
  {

    $this->page = $page ?? 1;
    $this->customer  = session(self::SESSION_CUSTOMER);
    $this->reciver = session(self::SESSION_RECIVER);
    $this->customerAddress = session('customerAddress');
    $this->reciverAddress = session('reciverAddress');

    if (auth('admin')->user()->type == 'manager') {

      $this->redirctToCustomerForm();
      $this->redirctToReciverForm();
    } else {
      $this->customerRedirctToReciverForm();
    }
    session([self::SESSION_PAGE => $this->page]);

    return (object) $this->data;
  }

  private function redirctToCustomerForm()
  {
    if ($this->page == 1 || ($this->page == 2 && !$this->customer) || ($this->page == 3 && !$this->customer && !$this->reciver)) {
      $this->page = 1;
      $this->setData($this->customer , $this->customerAddress);
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
    $this->data['address'] = new Address($address ?? $data);
  }
}
