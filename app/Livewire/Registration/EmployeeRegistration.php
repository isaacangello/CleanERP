<?php
namespace App\Livewire\Registration;

use App\Helpers\Funcs;
use App\Livewire\Forms\EmployeeForm;
use Livewire\Component;
use App\Models\Employee;
use HighSolutions\LaravelSearchy\Facades\Searchy;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
class EmployeeRegistration extends Component
{
    public EmployeeForm $femployee;

    public $search;
    public $searchFilterType = 'ALL';
    public $showEmployeeEdit = false;
    public $showEmployeeCreate = false;
    public $show = false;
    public $filterType;
    public $formType = 'EDIT';
    public $employee;
    use WithPagination;

    #[Computed]
    public function data()
    {
        if ($this->search) {
            if ($this->searchFilterType == 'ALL') {
                return Searchy::search('employees')->fields('name')->query($this->search)
                    ->getQuery()->limit(10)->get()->toArray();
            }
            if ($this->searchFilterType == 'COMMERCIAL') {
                return Searchy::search('employees')->fields('name')->query($this->search)
                    ->getQuery()->where('type', 'COMMERCIAL')->limit(10)->get()->toArray();
            }
            if ($this->searchFilterType == 'RESIDENTIAL') {
                return Searchy::search('employees')->fields('name')->query($this->search)
                    ->getQuery()->where('type', 'RESIDENTIAL')->limit(10)->get()->toArray();
            }
        } else {
            if($this->searchFilterType == 'ALL'){
                return Employee::paginate(Funcs::getConfig()->nun_reg_pages);
            }else{
            return Employee::where('type', $this->filterType)->orderBy('name')->paginate(Funcs::getConfig()->nun_reg_pages);
            }
        }
        return [];
    }

    public function render()
    {
        return view('livewire.registration.employee-registration');
    }

    public function changeStatus($id): void
    {
        $employee = Employee::find($id);
        $employee->status = $employee->status == 'active' ? 'inactive' : 'active';
        $employee->save();
        $this->dispatch('toast-alert', icon: 'success', message: 'Employee status changed successfully');
    }
    public function editEmployee($id): void
    {
        $this->employee = Employee::find($id);
        $this->femployee->name = $this->employee->name;
        $this->femployee->phone = $this->employee->phone;
        $this->femployee->email = $this->employee->email;
        $this->femployee->birth = $this->employee->birth;
        $this->dispatch('populate-date', idElement:"#input-edit-employee-birth", date:$this->employee->birth);
        $this->femployee->address = $this->employee->address;
        $this->femployee->name_ref_one = $this->employee->name_ref_one;
        $this->femployee->name_ref_two = $this->employee->name_ref_two;
        $this->femployee->phone_ref_one = $this->employee->phone_ref_one;
        $this->femployee->phone_ref_two = $this->employee->phone_ref_two;
        $this->femployee->restriction = $this->employee->restriction;
        $this->femployee->description = $this->employee->description;
        $this->femployee->document = $this->employee->document;
        $this->femployee->type = $this->employee->type;
        $this->femployee->status = $this->employee->status;
        $this->femployee->shift = $this->employee->shift;
        $this->femployee->username = $this->employee->username;
        $this->femployee->password = $this->employee->password;
        $this->femployee->new_user = $this->employee->new_user;
        $this->femployee->id = $this->employee->id;

        $this->showEmployeeEdit = true;
    }

    public function updateEmployee($id): void
    {
        $this->femployee->update($id);
        $this->showEmployeeEdit = false;
        $this->dispatch('toast-alert', icon:'success',message:'Employee updated successfully');
    }
    public function createEmployeeEvent(): void
    {
        $this->formType='CREATE';
        $this->femployee->type = $this->filterType;
        $this->femployee->status = 'ACTIVE';

        $this->show = true;
        $this->showEmployeeCreate = true;

    }
    public function createEmployee(): void
    {
        $this->femployee->create();
        $this->showEmployeeCreate = false;
        $this->dispatch('toast-alert', icon:'success',message:'Employee created successfully');
    }
}