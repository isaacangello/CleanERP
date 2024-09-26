<?php

namespace App\Livewire;
use App\Livewire\Forms\billingCad;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\config;
use App\Models\Billing;
class Billings extends Component
{
    public $billing;
    public $showHiddenRegs = false;

    #[Validate('numeric')]
    public $id;
    #[Validate('required|min:3|max:300')]
    public $label='';
    #[Validate('numeric')]
    public $value='';
    #[Validate('required|min:3|max:300')]
    public $hint='';

    // form properties
    public billingCad $form;
    public function newBilling(){
        //
        $this>$this->form->store();
        $this->dispatch('toast-alert',icon:'success',message:"this billing has been created!!!") ;
        $this->dispatch('close-modal', idElement:'new-billing');
        $this->refresh();
    }
    #[On('remove-billing')]
    public function remove($id): void
    {
        $result = Billing::find($id);
        //$this->authorize('delete',$result);
        //dd($this->showHiddenRegs);
        $result->delete();
        $this->dispatch('toast-alert',icon:'success',message:"this billing has been deleted!!!") ;
        $this->mount();
        $this->render();
    }
    public function toggleShowHiddenRegs():void{
//        $this->showHiddenRegs =!$this->showHiddenRegs;
        $this->mount();
        $this->render();
        $this->dispatch('disabledBtnDelete');

    }

    public function mount()
    {
        if ($this->showHiddenRegs){
            $this->billing = Billing::withTrashed()->get();
        }else{
        $this->billing = Billing::all();
        //dd($this->billing);
        }
    }
    #[On('refresh')]
    public function refresh()
    {
        $this->mount();
        $this->render();

    }
    public function render()
    {
        return view('livewire.billings')
            ->extends('layouts.app');
    }

    public function showtoast()
    {
        $this->dispatch('toast-alert',icon:'success',message:"ok is a message!!!") ;
        $this->dispatch('Billings::updated');
    }
}
