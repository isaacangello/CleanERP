<?php

namespace App\Livewire\Finance;

use App\Models\Payment;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Livewire\Forms\finance\paymentForm;
class PaymentsReg extends Component
{
    public paymentForm $form;
    public $payments;

    public $showHiddenRegs = false;
    protected $listeners = [
        'refresh' => '$refresh'
    ];
    public function toggleShowHiddenRegs(): void
    {
        $this->dispatch('updated-var-show',hiddenRegs:$this->showHiddenRegs);
    }

    #[Computed]
    public function data()
    {
        if($this->showHiddenRegs){
            $model = Payment::withTrashed();
            $this->payments = $model->get();
            return $this->payments;
        }else{
            $this->payments = Payment::all();
            return $this->payments;
        }
    }
    public function mount(){
        if($this->showHiddenRegs){
            $model = Payment::withTrashed();
            $this->payments = $model->get();
        }else{
            $model = Payment::all();
            $this->payments = $model;
        }
    }

    public function save(){

        $this->validate();
        Payment::create($this->form->all());
        $this->dispatch('toast-alert',icon:'success',message:"Payment method has been saved!!!") ;
        $this->dispatch('updated-var-show', $this->showHiddenRegs);
        $this->dispatch('close-modal', idElement:'new-payment');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('livewire.finance.payments-reg')->extends('layouts.app');
    }
}
