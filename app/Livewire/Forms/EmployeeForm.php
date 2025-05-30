<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'birth' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'name_ref_one' => 'nullable|string|max:255',
            'name_ref_two' => 'nullable|string|max:255',
            'phone_ref_one' => 'nullable|string|max:255',
            'phone_ref_two' => 'nullable|string|max:255',
            'restriction' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'document' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'new_user' => 'nullable|boolean|max:255',
        ];
    }
    public function store()
    {

    }
    public function create(): bool
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'birth' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'name_ref_one' => 'nullable|string|max:255',
            'name_ref_two' => 'nullable|string|max:255',
            'phone_ref_one' => 'nullable|string|max:255',
            'phone_ref_two' => 'nullable|string|max:255',
            'restriction' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'document' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'new_user' => 'nullable|boolean|max:255',
        ]);
        $this->employee = new Employee();
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
        $this->employee->status = "ACTIVE";
        $this->employee->shift = $this->shift;
        $this->employee->username = $this->username;
        $this->employee->password = $this->password ? Hash::make($this->password): Hash::make('1234');
        $this->employee->new_user = $this->new_user??true;
        $this->employee->save();
        $this->reset();
        return true;
    }
    public function update($id)
    {
        $validated = $this->validate();
//        dd($validated);
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
        $this->reset();
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
