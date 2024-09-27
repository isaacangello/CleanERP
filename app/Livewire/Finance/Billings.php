<?php

namespace App\Livewire\Finance;
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
        if($this->showHiddenRegs){
            $this->dispatch('disabledBtnDelete');
            return;
        }
        $result = Billing::find($id);
        //$this->authorize('delete',$result);
        //dd($this->showHiddenRegs);
        $result->delete();
        $this->dispatch('toast-alert',icon:'success',message:"this billing has been deleted!!!") ;
        $this->refresh();

        if($this->showHiddenRegs){
            $this->dispatch('disabledBtnDelete');
        }else{
            $this->dispatch('enableBtnDelete');
        }

    }
    public function toggleShowHiddenRegs():void{
        //dd($this->showHiddenRegs);
        $this->dispatch('tdRefresh',hiddenRegs:$this->showHiddenRegs)->to('finance.td' );
//        if($this->showHiddenRegs){
//            $this->dispatch('disabledBtnDelete');
//        }else{
//            $this->dispatch('enableBtnDelete');
//        }
        $this->mount();
        $this->render();

    }
    #[On('refresh')]
    public function refresh()
    {
        $this->mount();
        $this->render();

    }

    #[On('restoreBilling')]
    public function restore($id): void
    {
        $result = Billing::withTrashed()->find($id);
        $result->restore();
        $this->dispatch('refresh')->to('finance.billings');
        $this->dispatch('tdRefresh',hiddenRegs:$this->showHiddenRegs)->to('finance.td' );
        $this->dispatch('toast-alert',icon:'success',message:"This billing has been restored!!!");
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
    public function render()
    {
        return view('livewire.finance.billings')
            ->extends('layouts.app');
    }
}
