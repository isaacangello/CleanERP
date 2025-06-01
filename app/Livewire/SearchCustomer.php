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
    public $filterType;
    public $searchFilterType = 'ALL';
    public CustomerForm $fcustomer;
    public $customer;

    public function mount()
    {
        $this->billings = Billing::all();
        $this->fcustomer->type = strtoupper($this->filterType);
        $this->searchFilterType = 'ALL';

    }
public function editCustomerEvent($id){
        $this->dispatch('edit-customer', id:$id);
}
    #[Computed]
    public function data(){
//        $this->billings = Billing::get()->tArray();
//        dd($this->billings);
        if($this->search){
//            dd($this->search , $this->searchFilterType);
            if($this->searchFilterType === 'ALL' or is_null($this->searchFilterType)) {
                return  Searchy::search('customers')->fields('name','email')->query("$this->search")
                    ->getQuery()->limit(10)->get()->toArray();

            }
            if($this->searchFilterType === 'COMMERCIAL') {
                return Searchy::search('customers')->fields('name')->query($this->search)
                    ->getQuery()->where('type', 'COMMERCIAL')->limit(10)->get()->toArray();
            }
            if($this->searchFilterType === 'RESIDENTIAL') {
                return Searchy::search('customers')->fields('name')->query($this->search)
                    ->getQuery()->where('type', 'RESIDENTIAL')->orWhere('type','HENTALHOUSE')->limit(10)->get()->toArray();
            }

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
        $this->fcustomer->changeStatus($id);
        $this->dispatch('toast-alert', icon:'success',message:'Customer status changed successfully');
    }
}
