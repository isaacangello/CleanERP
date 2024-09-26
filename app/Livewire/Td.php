<?php

namespace App\Livewire;
use AllowDynamicProperties;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Models\Billing;
use Livewire\Component;

#[AllowDynamicProperties] class Td extends Component
{
    #[Validate('numeric')]
    public $value;
    #[Validate('required|min:3|max:300')]
    public $label;
    #[Validate('required|min:3|max:300')]
    public $hint;
    #[Validate('numeric')]
    public $id;
    public $model;
    public $showHiddenRegs;
    public function saveChange($field){
        $this->validate();
//        dd($id,$fieldName,$value);

        $result = Billing::find($this->id);
        $result->value = $this->value;
        $result->label = $this->label;
        $result->hint = $this->hint;

        //dd($result);
        $result->save();
        $this->dispatch('wire-toast-alert',icon:'success',message:"this field $field has bean changed !!!") ;
        $this->mount();
        $this->render();

    }
    public function deleteBilling($id): void
    {
        $this->dispatch('remove-billing', id: $id);
    }
    public function mount($showHiddenRegs = null)
    {
    //dd($this->showHiddenRegs);
      // $billing = Billing::find($this->id);
        //dd($this->model);
        $this->showHiddenRegs = $showHiddenRegs;
        $this->value = $this->model->value;
        $this->label = $this->model->label;
        $this->hint = $this->model->hint;
    }
    #[On('tdRefresh')]
    public function tdRefresh(){
        $this->mount();
        $this->render();
    }
    public function render()
    {
        return view('livewire.td');
    }

}
