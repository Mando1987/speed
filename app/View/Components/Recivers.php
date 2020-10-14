<?php

namespace App\View\Components;

use App\Models\Reciver;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Recivers extends Component
{
    public $name;
    public $selected;
    public $recivers;
    public $adminType;
    public $adminId;
    public function __construct($name = 'reciver_id', $selected = 1 , $adminType = 'manager' , $adminId =1)
    {
        $this->name = Str::contains($name, '[]')? Str::replaceFirst('[', '[reciver_id', $name) : $name;
        $this->selected = $selected;
        $this->adminType = $adminType;
        $this->adminId = $adminId;

        $this->recivers = Reciver::where(function($query) use ($adminType , $adminId){
           return $query->when($adminType=='customer', function($q) use($adminId){
               return $q->where('customer_id',$adminId);
            });

        })->get();
    }

    public function render()
    {
        return view('components.recivers');
    }
}
