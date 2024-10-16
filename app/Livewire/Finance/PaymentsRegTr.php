<?php

namespace App\Livewire\Finance;

use App\Models\Payment;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PaymentsRegTr extends Component
{
    public int $id;
    #[Validate('required|min:3|max:300')]
    public string $title='';
    #[Validate('required|min:3|max:300')]
    public string $notes = "";
    public $row='';
    public $showHiddenRegs= false;
    #[Computed]
    public function data(): void
    {
        //dd($this->id);
        $this->extracted();

    }
    #[On('updated-var-show')]
    public function updatedVarShow($hiddenRegs){
        $this->showHiddenRegs = $hiddenRegs;
    }

    public function updateReg()
    {
        $temp =  Payment::find($this->id);
        $temp->title = $this->title;
        $temp->notes = $this->notes;
        $temp->save();
        $this->dispatch('toast-alert',icon:'success',message:"this Payment method has been updated!!!") ;
        $this->dispatch('updated-var-show', $this->showHiddenRegs);

    }
    public function mount(){
        //dd($this->id);
        $this->extracted();

    }
    public function delete()
    {
        $this->row = Payment::withTrashed()->find($this->id);
        $this->row->delete();
        $this->dispatch('toast-alert',icon:'success',message:"this Payment method has been deleted!!!") ;
        $this->dispatch('updated-var-show', $this->showHiddenRegs);
        $this->dispatch('deleted');
//        $this->mount();
//        $this->render();
    }
    public function restore(){
        $this->row = Payment::withTrashed()->find($this->id);
        $this->row->restore();
        $this->dispatch('toast-alert',icon:'success',message:"this Payment method has been restored!!!") ;
        $this->dispatch('updated-var-show', $this->showHiddenRegs);
        $this->dispatch('deleted');
    }
    public function render()
    {
        return view('livewire.finance.payments-reg-tr');
    }

    /**
     * @return void
     */
    public function extracted(): void
    {
        if ($this->showHiddenRegs) {
            $this->row = Payment::withTrashed()->find($this->id);
            $this->id = $this->row->id;
            $this->title = $this->row->title;
            $this->notes = $this->row->notes;

        } else {
            $pClass = new Payment();
            $this->row = $pClass->where('id','=',$this->id)->first();
//            dd($this->row->title);
            $this->title = $this->row->title;
            $this->notes = $this->row->notes;
        }
    }
}
