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
use Livewire\WithPagination;

class CustomerRegistration extends Component
{
    use WithPagination;
    public $search = '';
    public $status = '';
    public $showCustomerEdit = false;
    public $show = false;
    public $formType = 'EDIT';
    public $searchFilterType = 'ALL';
    public $filterType = 'ALL';
    public $showEmployeeEdit = false;
    public $billings = [];
    public $selectedOptions = [];
    public $selectedValues = [];
    public $billingsSelected = [];

    public CustomerForm $fcustomer;
    public $customer;

    public function mount():void
    {

        $this->billings = Billing::all()->toArray();
    }
    public function createCustomerEvent():void{

        $this->fcustomer->resetForm($this->filterType);
        $this->formType = 'CREATE';
        $this->showCustomerEdit = true;
    }
    public function createCustomerTest():void{
        $this->formType = 'CREATE';
        $this->fcustomer->fill(
            [
                'name' => '',
                'email' => ' ',
                'phone' => ' ',
                'address' => ' ',
                'complement' => ' ',
                'type' => $this->filterType,
                'billing_values_selected' => [],
                'others_emails' => ' ',
                'other_services' => ' ',
                'frequency' => ' ',
                'house_description' => ' ',
                'note' => ' ',
                'info' => ' ',
                'drive_licence' => false,
                'key' => false,
                'more_girl' => false,
                'gate_code' => false,
                'status' => 'ACTIVE',
            ]
        );

        $this->show = true;
    }

    public function saveNewCustomer():void{
        $this->fcustomer->formType = 'CREATE';
       // dd($this->fcustomer);
        $result = $this->fcustomer->create();
        if($result){
            $this->dispatch('toast-alert', icon:'success',message:'Customer created successfully');
            $this->showCustomerEdit = false;
        }else{
            $this->dispatch('toast-alert', icon:'error',message:'Error creating customer');
            return;
        }
        $this->dispatch('toast-alert', icon:'success',message:'Customer created successfully');
        $this->showCustomerEdit = false;
    }

public function editCustomerEvent($id)
{
    $this->customer = \App\Models\Customer::find($id);

    $this->fcustomer->fill([
        'name' => $this->customer->name,
        'email' => $this->customer->email,
        'phone' => $this->customer->phone,
        'address' => $this->customer->address,
        'complement' => $this->customer->complement,
        'type' => $this->customer->type,
        'billing_values_selected' => DB::table('billings_customers')->where('customer_id', $this->customer->id)->pluck('billing_id')->all(),
        'others_emails' => $this->customer->others_emails,
        'other_services' => $this->customer->other_services,
        'frequency' => $this->customer->frequency,
        'house_description' => $this->customer->house_description,
        'note' => $this->customer->note,
        'info' => $this->customer->info,
        'drive_licence' => $this->customer->drive_licence == 1,
        'key' => $this->customer->key == 1,
        'more_girl' => $this->customer->more_girl == 1,
        'gate_code' => $this->customer->gate_code == 1,
    ]);

    $this->showCustomerEdit = true;
}
    public function updateCustomer($id): void
    {
        $this->fcustomer->billing_values_selected = $this->billingsSelected;
        $this->fcustomer->update($id);
        $this->showCustomerEdit = false;
        $this->dispatch('toast-alert', icon:'success',message:'Customer updated successfully');
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
            return  Customer::where('type', $this->filterType)->orderBy('name')->paginate($config->nun_reg_pages);
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
