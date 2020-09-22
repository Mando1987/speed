<?php
namespace App\Services\Dashboard;

class CustomerService
{
   public function __construct(){
      echo 'customer';
   }

   public function index()
   {
       return view('dashboard.customer');
   }
}