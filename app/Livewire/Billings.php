<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\config;
use App\Models\Billing;
class Billings extends Component
{
    public $billing;
    public $id;
    public $fieldName;
    public $value;
    public function mount()
    {
        $this->billing = Billing::all();
    }
    public function render()
    {
        return view('livewire.billings')
            ->extends('layouts.app')
            ;



    }
    public function toast(){
      $this->dispatch('                    
                        toastAlert.fire({
                        icon: "success",
                        title: "teste de evento"
                    });
');

    }
    public function saveChange($id,$fieldName,$value){
        $result = $this->billing->find($id);
        $result->update([
            $this->fieldName => $this->value
        ]);
        $result->save();

    }
}
