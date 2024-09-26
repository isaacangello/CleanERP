<?php

namespace App\Livewire\Forms;

use App\Models\Billing;
use Livewire\Attributes\Validate;
use Livewire\Form;

class billingCad extends Form
{
    #[Validate('required|min:3|max:300')]
    public $label ='';
    #[Validate('numeric|min:1')]
    public $value =0;
    #[Validate('required|min:3|max:300')]
    public $hint ='';

    public function store()
    {
        $this->validate();

        Billing::create($this->all());
    }
}
