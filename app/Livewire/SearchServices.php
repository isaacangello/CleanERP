<?php

namespace App\Livewire;

use App\Http\Controllers\Populate;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Helpers\WeekNavigation;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use App\Models\Service;
use Livewire\WithPagination;

class SearchServices extends Component
{
    use WithPagination;
    use WeekNavigation;
    public $services=null;
    public $employees;
    public $customers;
    public $id = 0;
    public $selectAll = false;
    public $filterType = "RESIDENTIAL";
    public $selectedEmployee=0;
    public $selectedCustomer=0;
    public $selectedServices = [];
    public function searchedServices()
    {
        //$this->dispatch('toast-alert',icon:'info', title:"Info", text:'Searching services');
        $tempServices = new Service();
        if($this->selectedEmployee === 0 and $this->selectedCustomer === 0){
            $this->dispatch('toast-btn-alert',icon:'error', title:"Error", text:'Please select a customer or an employee');
            return null;
        }
        $tempServices = $tempServices->with('employee','customer','control');
        if($this->selectedEmployee>0)
        {
            $tempServices = $tempServices->where('employee1_id','=',$this->selectedEmployee);
        }
        if($this->selectedCustomer>0)
        {
            $tempServices = $tempServices->where('customer_id','=',$this->selectedCustomer);
        }
        $tempServices = $tempServices->where('service_date','>=',$this->from)->where('service_date','<=',$this->till)->orderBy('service_date','desc');

        $this->services =  $tempServices->paginate(10)->toArray();
//        dd($this->services);
    }
    public function mount()
    {
//        dd(Populate::employeeFilter('RESIDENTIAL')->toArray());
        $this->customers = Populate::customerFilter('RESIDENTIAL')->toArray();
        $this->employees = Populate::employeeFilter('RESIDENTIAL')->toArray();

        $this->initVars();
    }
    public function render()
    {
        return view('livewire.search-services');
    }
    public function updatedSelectAll()
    {
        if($this->selectAll)
        {
            $this->selectedServices = array_column($this->services['data'],'id');
        }else{
            $this->selectedServices = [];
        }
    }
    public function updated()
    {
        $this->updatedSelectAll();
    }
}
