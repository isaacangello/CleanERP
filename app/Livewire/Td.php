<?php

namespace App\Livewire;

use App\Models\Billing;
use Livewire\Component;

class Td extends Component
{
    public $value;
    public $label;
    public $hint;
    public $id;
    public function saveChange($field){
        //$his->validate();
//        dd($id,$fieldName,$value);
        $result = Billing::find($this->id);

        $result->value = $this->value;
        $result->label = $this->label;
        $result->hint = $this->hint;

        //dd($result);
        $result->save();
        $this->dispatch('toast-alert',icon:'success',message:"this field $field has bean changed !!!") ;
    }

    public function mount()
    {
        $billing = Billing::find($this->id);
        $this->value = $billing->value;
        $this->label = $billing->label;
        $this->hint = $billing->hint;
    }
    public function render()
    {
        return view('livewire.td');
    }
}
