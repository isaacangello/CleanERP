<?php

namespace App\Livewire;

use App\Livewire\Forms\EmployeeForm;
use HighSolutions\LaravelSearchy\Facades\Searchy;
use Livewire\Attributes\Computed;
use Livewire\Component;


class SearchEmployee extends Component
{
    public $search = '';
    public EmployeeForm $femployee;
    #[Computed]
    public function data(){
        if($this->search){
//            dd(Searchy::search('employees')->fields('name')->query($this->search)
//                ->getQuery()->limit(10)->get()->toArray());
            return Searchy::search('employees')->fields('name')->query($this->search)
                ->getQuery()->limit(10)->get()->toArray();
        }else{
            return [];
        }

    }
    public function render()
    {
        return view('livewire.search-employee');
    }
    public function editEmployeeEvent($id){
        $this->dispatch('edit-employee', id:$id);
    }
    public function changeStatus($id): void
    {
        $this->femployee->changeStatus($id);
        $this->dispatch('toast-alert', icon:'success',message:'Employee status changed successfully');
    }
}
