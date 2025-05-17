<?php

namespace App\Livewire;

use App\Helpers\Residential\ResidentialTrait;
use App\Http\Controllers\Populate;
use App\Models\Customer;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CadService extends ModalComponent
{
    use ResidentialTrait;
    public $populateBillings = null;
    public $numWeek= 0;
    public $week= 0;
    public $year= 0;
    public $selectedWeek=0;
    public $selectedYear= 0;
    public $selectOptionsCustomers='';
    public $selectOptionsEmployees='';
    public function price_inject(): void
    {
//        dd($this->form->customer_id);
        $temp_customer = Customer::with('billings')->find($this->form->customer_id);
        $this->populateBillings = $temp_customer->billings;
    }


    public function mount(): void
    {
        $dateTrait = new DateTreatment();
        $this->traitNullVars();
        if($this->from and ($this->numWeek === null)){
            $this->numWeek = $dateTrait->numberWeekByDay(Carbon::create($this->from)->nextWeekday()->format('Y-m-d'));
        }
        if (empty($this->selectedWeek) ){$this->selectedWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));}
        if($this->selectedYear === null){$this->selectedYear = $this->year;}


        $this->week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);

        $this->selectOptionsEmployees = Populate::employeeFilter();
        $this->selectOptionsCustomers = Populate::customerFilter();

    }
    public function render()
    {
        return view('livewire.cad-service');
    }
}
