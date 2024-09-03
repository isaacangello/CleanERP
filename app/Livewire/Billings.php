<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\config;
use App\Models\Billing;
class Billings extends Component
{
    public $billings;
    public function mount()
    {
        $this->billings = Billing::all();
    }
    public function render()
    {
        return view('livewire.billings')
            ->extends('layouts.app')
            ;



    }
}
