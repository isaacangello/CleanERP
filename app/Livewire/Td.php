<?php

namespace App\Livewire;

use Livewire\Component;

class Td extends Component
{
    public $value;
    public $label;
    public function render()
    {
        return view('livewire.td');
    }
}
