<?php

namespace App\Livewire\Forms\finance;

use App\Models\Payment;
use Livewire\Attributes\Validate;
use Livewire\Form;

class paymentForm extends Form
{
    #[Validate('required|min:3|max:300')]
    public string $title='';
    #[Validate('required|min:3|max:300')]
    public string $notes = "";
    public function store()
    {
        $this->validate();
        Payment::createOrRestore($this->all());
    }
}
