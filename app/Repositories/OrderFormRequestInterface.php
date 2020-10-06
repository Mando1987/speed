<?php
namespace App\Repositories;

interface OrderFormRequestInterface
{
   public function rules();
   public function validated();
}
