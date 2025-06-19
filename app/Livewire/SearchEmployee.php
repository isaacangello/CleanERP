<?php

namespace App\Livewire;

use App\Helpers\Funcs;
use App\Livewire\Forms\EmployeeForm;
use App\Models\Employee;
use HighSolutions\LaravelSearchy\Facades\Searchy;
use Livewire\Attributes\Computed;
use Livewire\Component;


class SearchEmployee extends Component
{
    public $search = '';
    public $searchFilterType = 'ALL';

    public EmployeeForm $femployee;
    #[Computed]
    public function data(){
        $config = Funcs::getConfig();
        if($this->search){
          if($this->searchFilterType == 'ALL') {
              return Searchy::search('employees')->fields('name')->query($this->search)
                  ->getQuery()->limit(10)->get()->toArray();
          }
          if($this->searchFilterType == 'COMMERCIAL') {
              return Searchy::search('employees')->fields('name')->query($this->search)
                  ->getQuery()->where('type', 'COMMERCIAL')->limit(10)->get()->toArray();
          }
          if($this->searchFilterType === 'RESIDENTIAL') {
                return Searchy::search('employees')->fields('name')->query($this->search)
                    ->getQuery()->where('type', 'RESIDENTIAL')->orWhere('type', 'HENTALHOUSE')->limit(10)->get()->toArray();
          }


        }else{
            return Employee::paginate($config->nun_reg_pages);
        }

    }
    public function mount()
    {
        $this->searchFilterType = 'ALL';
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
