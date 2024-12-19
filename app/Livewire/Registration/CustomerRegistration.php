<?php

namespace App\Livewire\Registration;

use App\Helpers\Funcs;
use App\Livewire\Forms\CustomerForm;
use App\Models\Billing;
use HighSolutions\LaravelSearchy\Facades\Searchy;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Customer;

class CustomerRegistration extends Component
{
    public $search = '';
    public $status = '';
    public $showCustomerEdit = false;
    public $formType = 'CREATE';
    public $searchFilterType = 'ALL';
    public $filterType = 'ALL';
    public $showEmployeeEdit = false;
    public $billings = [];
    public $selectedOptions = [];
    public $selectedValues = [];
    public $billingsSelected = [];

    public CustomerForm $fcustomer;
    public $customer;

    public function mount()
    {

        $this->billings = Billing::all()->toArray();
    }
    public function createCustomerEvent(){
        $this->fcustomer->reset($this->filterType);
        $this->showCustomerEdit = true;
    }

    public function editCustomerEvent($id){

        $this->customer = \App\Models\Customer::find($id);
        //dd("clicou" ,$this->customer);
        $this->fcustomer->name = $this->customer->name;
        $this->fcustomer->email = $this->customer->email;
        $this->fcustomer->phone = $this->customer->phone;
        $this->fcustomer->address = $this->customer->address;
        $this->fcustomer->complement = $this->customer->complement;
        $this->fcustomer->type = $this->customer->type;
        $temp = DB::table('billings_customers')->where('customer_id', $this->customer->id)->get();
        $this->billingsSelected = $temp->pluck('billing_id')->all();
        $this->fcustomer->billing_values_selected = $this->billingsSelected;
        foreach ($this->billingsSelected as $key => $value) {
            $billing_temp = DB::table('billings')->where('id', $value)->first();
            $this->selectedValues []= $billing_temp->value;
        }
        //dd($this->customer->drive_licence,$temp, $temp->pluck('billing_id')->all());

        $this->fcustomer->others_emails = $this->customer->others_emails;
        $this->fcustomer->other_services = $this->customer->other_services;
        $this->fcustomer->frequency = $this->customer->frequency;
        $this->fcustomer->house_description = $this->customer->house_description;
        $this->fcustomer->note = $this->customer->note;
        $this->fcustomer->info = $this->customer->info;
        if($this->customer->drive_licence == 1) {
            $this->fcustomer->drive_licence = true;
        }else{
            $this->fcustomer->drive_licence = false;
        }
        if($this->customer->key == 1) {
            $this->fcustomer->key = true;
        }else{
            $this->fcustomer->key = false;
        }
        if($this->customer->more_girl == 1) {
            $this->fcustomer->more_girl = true;
        }else{
            $this->fcustomer->more_girl = false;
        }
        if($this->customer->gate_code == 1) {
            $this->fcustomer->gate_code = true;
        }else{
            $this->fcustomer->gate_code = false;
        }

        //dd($this->customer->type);
        $this->showCustomerEdit = true;
    }
    #[Computed]
    public function data(){
        $config = Funcs::getConfig();
//        $this->billings = Billing::get()->toArray();
//        dd($this->billings);
        if($this->search){
            if($this->searchFilterType == 'ALL') {
                return  Searchy::search('customers')->fields('name')->query($this->search)
                    ->getQuery()->limit(10)->get()->toArray();

            }
            if($this->searchFilterType == 'COMMERCIAL') {
                return Searchy::search('customers')->fields('name')->query($this->search)
                    ->getQuery()->where('type', 'COMMERCIAL')->limit(10)->get()->toArray();
            }
            if($this->searchFilterType == 'RESIDENTIAL') {
                return Searchy::search('customers')->fields('name')->query($this->search)
                    ->getQuery()->where('type', 'RESIDENTIAL')->orWhere('type','HENTALHOUSE')->limit(10)->get()->toArray();
            }

        }else{
            return  Customer::where('type', $this->filterType)->paginate($config->nun_reg_pages);
        }


    }

    public function render()
    {
        return view('livewire.registration.customer-registration');
    }

    public function changeStatus($id): void
    {
        $this->fcustomer->changeStatus($id);
        $this->dispatch('toast-alert', icon:'success',message:'Customer status changed successfully');
    }

}
