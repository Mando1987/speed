<?php
namespace App\TestFolder;

class TestClass
{
  // to fix error when Undefined property in this class
//   public function __get($value)
//   {
//       return $value;
//   }
  public function handle($array)
  {
     foreach ($array as $key => $value) {

        if(is_array($value)){
            $this->$key = (object) $value;
        }else{

            $this->$key =  $value;
        }
     }
     return $this;
  }
}