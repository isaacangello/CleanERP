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
    public $hint;
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

    public function showtoast()
    {
        //dd('ok');
        $this->dispatch('toast-alert',icon:'success',message:"ok is a message!!!") ;
    }
}
