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
         return Searchy::search('customers')->fields('name')->query($this->search)
             ->getQuery()->limit(10)->get()->toArray();
        }else{
            return [];
        }


    }
    public function render()
    {
        return view('livewire.search-customer');
    }
}
