<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerForm extends Form
{
    //
    public $customer;
    public $name;
    public $type;
    public $address;
    public $complement;
    public $phone;
    public $email;
    public $billing_values_selected = [];

    public $others_emails;
    public $other_services;
    public $frequency;
    public $house_description;
    public $note;
    public $drive_licence;
    public $key;
    public $more_girl;
    public $gate_code;
    public $justify_inactive;
    public $info;
    public $status;
    public function update($id)
    {
//        dd($this->billing_values_selected);
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'complement' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'billing_values_selected' => 'nullable|array',
            'other_services' => 'nullable|string',
            'frequency' => 'nullable|string|max:255',
            'house_description' => 'nullable|string',
            'note' => 'nullable|string',
        ]);
        $this->customer = Customer::find($id);
        $this->customer->name = $this->name;
        $this->customer->type = $this->type;
        $this->customer->address = $this->address;
        $this->customer->complement = $this->complement;
        $this->customer->phone = $this->phone;
        $this->customer->email = $this->email;
        $this->customer->other_services = $this->other_services;
        $this->customer->frequency = $this->frequency;
        $this->customer->house_description = $this->house_description;
        $this->customer->note = $this->note;
        $this->customer->drive_licence = $this->drive_licence;
        $this->customer->key = $this->key;
        $this->customer->more_girl = $this->more_girl;
        $this->customer->gate_code = $this->gate_code;
        $this->customer->save();
        $this->customer->billings()->sync($this->billing_values_selected);
            return true;
    }
    public function create()
{
    $this->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'complement' => 'nullable|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'billing_values_selected' => 'nullable|array',
        'other_services' => 'nullable|string',
        'frequency' => 'nullable|string|max:255',
        'house_description' => 'nullable|string',
        'note' => 'nullable|string',
    ]);

    $customer = new Customer();
    $customer->name = $this->name;
    $customer->type = $this->type;
    $customer->address = $this->address;
    $customer->complement = $this->complement;
    $customer->phone = $this->phone;
    $customer->email = $this->email;
    $customer->other_services = $this->other_services;
    $customer->frequency = $this->frequency;
    $customer->house_description = $this->house_description;
    $customer->note = $this->note;
    $customer->drive_licence = $this->drive_licence;
    $customer->key = $this->key;
    $customer->more_girl = $this->more_girl;
    $customer->gate_code = $this->gate_code;
    $customer->status = 'ACTIVE'; // Definindo status padrão como 'ACTIVE'
    $customer->save();

    $customer->billings()->sync($this->billing_values_selected);

    return true;
}
    public function changeStatus($id): true
    {
        $this->customer = Customer::find($id);
        if ( $this->customer->status == 'INACTIVE'){
            $this->customer->status = 'ACTIVE';
        }else{
            $this->customer->status = 'INACTIVE';
        }
        if(is_null($this->customer->status)){
            $this->customer->status = 'ACTIVE';
        }

        $this->customer->save();
        return true;
    }
    public function resetForm($filterType = "RESIDENTIAL"):void
        {
            $this->name = '';
            $this->type = $filterType;
            $this->address = '';
            $this->complement = '';
            $this->phone = '';
            $this->email = '';
            $this->billing_values_selected = [];
            $this->others_emails = '';
            $this->other_services = '';
            $this->frequency = '';
            $this->house_description = '';
            $this->note = '';
            $this->drive_licence = '';
            $this->key = '';
            $this->more_girl = '';
            $this->gate_code = '';
            $this->justify_inactive = '';
            $this->info = '';
            $this->status = '';
        }
}
