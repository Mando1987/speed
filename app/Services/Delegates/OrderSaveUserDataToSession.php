<?php

namespace App\Services\Orders;

class OrderSaveUserDataToSession

{
  const SESSION_SENDER  = 'sender';
  const SESSION_RECIVER = 'reciver';
  const SESSION_PAGE    = 'page';

  public  $fullname;
  public  $phone;
  public  $governorate_id = 1;
  public  $address;
  public  $special_marque;
  public  $house_number;
  public  $door_number;
  public  $shaka_number;
  public  $city_id = 1;
  public  $other_phone;
  public  $page;
  private $sender;
  private $reciver;

  public function handle($page = null)
  {

    $this->page = $page ?? 1;

    $this->sender  = session(self::SESSION_SENDER);
    $this->reciver = session(self::SESSION_RECIVER);

    $this->redirctToSenderForm();
    $this->redirctToReciverForm();

    session([self::SESSION_PAGE => $this->page]);

    return $this;
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

  private function setData($userData)
  {
    if (is_array($userData)) {

      foreach ($userData as $key => $val) {
        $this->$key = $val;
      }
    }
  }
}
