<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Models\Billing;
use App\Models\Customer;
use HighSolutions\LaravelSearchy\Facades\Searchy;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Livewire\Forms\CustomerForm;

#[AllowDynamicProperties] class SearchCustomer extends Component
{

    public $search = '';
    public $billings = [];
    public $status = '';
    public CustomerForm $fcustomer;
    public $customer;

    public function mount()
    {
        $this->billings = Billing::all();
    }
public function editCustomerEvent($id){
        $this->dispatch('edit-customer', id:$id);
}
    #[Computed]
    public function data(){
//        $this->billings = Billing::get()->toArray();
//        dd($this->billings);
        if($this->search){
            $result = Searchy::search('customers')->fields('name')->query($this->search)
                ->getQuery()->limit(10)->get()->toArray();
         return $result;
        }else{
            return [];
        }


    }
    public function render()
    {
        return view('livewire.search-customer');
    }
    public function changeStatus($id): void
    {
        $this->fcustomer->status = $this->status ;
        $this->fcustomer->changeStatus($id);
        $this->dispatch('toast-alert', icon:'success',message:'Customer status changed successfully');
    }
}
