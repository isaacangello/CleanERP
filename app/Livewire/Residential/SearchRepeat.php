<?php

namespace App\Livewire\Residential;

use App\Helpers\WeekNavigation;
use App\Livewire\Forms\CustomerForm;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class SearchRepeat extends Component
{
    use WeekNavigation;
    public CustomerForm $fcustomer;

    public $searchResults = "";
    public $tabService = true;
    public $tabRepeat = false;
    public $tabCustomer = false;
    public $tabEmployee = false;
    public $showCustomerEdit = false;
    public $showEmployeeEdit = false;
    public $billings = [];
    public $selectedOptions = [];
    public $selectedValues = [];
    public $billingsSelected = [];
    public $customer;
    public $status = 'active';
    public $employee;

    public function editCustomer($id): void
    {

        $this->customer = Customer::find($id);
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


        $this->showCustomerEdit = true;

    }
    public function editEmployee($id): void
    {
        $this->employee = Employee::find($id);
        $this->showEmployeeEdit = true;
    }
    public function updateCustomer($id): void
    {
        $this->fcustomer->billing_values_selected = $this->billingsSelected;

        $this->fcustomer->update($id);
        $this->showCustomerEdit = false;
        $this->dispatch('toast-alert', icon:'success',message:'Customer updated successfully');
    }

    public function mount()
    {
        $this->initVars();
        $this->billings = Billing::all()->toArray();
    }
    public function render()
    {
        return view('livewire.residential.search-repeat')
            ->extends('layouts.app');
    }
}
