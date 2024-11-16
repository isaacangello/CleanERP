<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeForm extends Form
{
    public $employee;
    public $name;
    public $phone;
    public $email;
    public $birth;
    public $address;
    public $name_ref_one;
    public $name_ref_two;
    public $phone_ref_one;
    public $phone_ref_two;
    public $restriction;
    public $description;
    public $document;
    public $type;
    public $status;
    public $shift;
    public $username;
    public $password;
    public $new_user;

    public function update($id)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birth' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'name_ref_one' => 'nullable|string|max:255',
            'name_ref_two' => 'nullable|string|max:255',
            'phone_ref_one' => 'nullable|string|max:255',
            'phone_ref_two' => 'nullable|string|max:255',
            'restriction' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'document' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'shift' => 'nullable|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'new_user' => 'nullable|boolean|max:255',
        ]);

        $this->employee = Employee::find($id);
        $this->employee->name = $this->name;
        $this->employee->phone = $this->phone;
        $this->employee->email = $this->email;
        $this->employee->birth = $this->birth;
        $this->employee->document = $this->document;
        $this->employee->address = $this->address;
        $this->employee->name_ref_one = $this->name_ref_one;
        $this->employee->name_ref_two = $this->name_ref_two;
        $this->employee->phone_ref_one = $this->phone_ref_one;
        $this->employee->phone_ref_two = $this->phone_ref_two;
        $this->employee->restriction = $this->restriction;
        $this->employee->description = $this->description;
        $this->employee->type = $this->type;
        $this->employee->status = $this->status;
        $this->employee->shift = $this->shift;
        $this->employee->username = $this->username;
        $this->employee->password = Hash::make($this->password);
        $this->employee->new_user = $this->new_user;
        $this->employee->save();
        return true;
        //
    }
    public function changeStatus($id): true
    {

        $this->employee = Employee::find($id);
        if ($this->employee->status == 'ACTIVE') {
            $this->employee->status = 'INACTIVE';
        } else {
            $this->employee->status = 'ACTIVE';
        }
        if(is_null($this->employee->status)){
            $this->employee->status = 'ACTIVE';
        }
        $this->employee->save();
        return true;

    }
}
