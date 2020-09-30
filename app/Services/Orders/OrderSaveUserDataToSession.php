<?php

namespace App\Services\Orders;

class OrderSaveUserDataToSession
{
  const SESSION_SENDER  = 'sender';
  const SESSION_RECIVER = 'reciver';
  const SESSION_PAGE    = 'page';

  public  $page;

  public $data = [
    'fullname'       => '',
    'phone'          => '',
    'governorate_id' => 1 ,
    'city_id'        => 1 ,
    'other_phone'    => '',
    'special_marque' => '',
    'house_number'   => '',
    'address'        => '',
    'door_number'    => '',
    'shaka_number'   => '',
    'page'           => '',
  ];

  private $sender;
  private $reciver;

  public function handle($page = null)
  {

    $this->page = $page ?? 1;
    $this->sender  = session(self::SESSION_SENDER);
    $this->reciver = session(self::SESSION_RECIVER);

    if (auth('admin')->user()->type == 'manager') {

      $this->redirctToSenderForm();
      $this->redirctToReciverForm();
    } else {
      $this->customerRedirctToReciverForm();
    }
    session([self::SESSION_PAGE => $this->page]);

    return (object) $this->data;
  }

  private function redirctToSenderForm()
  {
    if ($this->page == 1 || ($this->page == 2 && !$this->sender) || ($this->page == 3 && !$this->sender && !$this->reciver)) {
      $this->page = 1;
      $this->setData($this->sender);
    }
  }

  private function redirctToReciverForm()
  {
    if ($this->page == 2 || ($this->page == 3 && $this->sender && !$this->reciver)) {
      $this->page = 2;
      $this->setData($this->reciver);
    }
  }
  private function customerRedirctToReciverForm()
  {
    if ($this->page == 1 || ($this->page == 2 && !$this->reciver)) {
      $this->page = 1;
      $this->setData($this->reciver);
    }
  }

  private function setData($userData)
  {
    if (is_array($userData)) {
      foreach ($userData as $key => $val) {
        $this->data[$key] = $val;
      }
    }
  }
}
