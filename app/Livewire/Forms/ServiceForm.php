<?php

namespace App\Livewire\Forms;

use App\Helpers\Funcs;
use App\Models\Service;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServiceForm extends Form
{
    public $who_saved;
    public $who_saved_id;
    #[Validate('required|numeric')]
    public $customer_id='';
    #[Validate('required|numeric')]
    public $employee1_id;
    #[Validate('nullable')]
    public $employee2_id;
    #[Validate('nullable')]
    public $frequency;
    #[Validate('nullable')]
    public $notes='';
    #[Validate('nullable')]
    public $instructions='';
    #[Validate('required')]
    public$service_date='';
    #[Validate('nullable', message: 'Please provide the Price')]
    public $frequency_payment;
    #[Validate('required')]
    public $service_time='';
    public function store():bool
    {

        $this->validate();
//        $service_date = Funcs::dateTimeToDB($this->service_date,$this->service_time); //Carbon::create($this->service_date." ".$this->service_time)->format('Y-m-d H:i:s');
        if($this->employee2_id === "0"){$employee2_id = $this->employee1_id;}else{$employee2_id = $this->employee2_id;}
        $frequency_payment = explode(',',$this->frequency_payment);
        $return = Service::create([
                'customer_id' => $this->customer_id,
                'employee1_id' =>$this->employee1_id,
                'employee2_id'=>$employee2_id,
                'service_date'=>$this->service_date,
                'period'=>$this->period,
                'frequency'=>$this->frequency,
                'notes' => $this->notes,
                'instructions' => $this->instructions,
                'frequency_payment'=>$frequency_payment[0]??null,
                'price'=>$frequency_payment[1]??0,
                'payment'=> null,
                'who_saved'=>\Auth::user()->name,
                'who_saved_id'=>\Auth::id(),
            ]
        );
        //dd($return);
        $this->reset();
        return true;
    }
}
