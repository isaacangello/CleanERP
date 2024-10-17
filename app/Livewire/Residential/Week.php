<?php

namespace App\Livewire\Residential;

use AllowDynamicProperties;
use App\Helpers\Residential\ResidentialTrait;
use App\Http\Controllers\Populate;
use App\Models\Employee;
use App\Models\Service;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Http\Controllers\PopulateController;

#[AllowDynamicProperties] class Week extends Component
{
    use ResidentialTrait;
    #[Url]
    public $id;
    public $from;
    public $till;
    public $numWeek = null;
    public $year = null;
    public $selectOptionsEmployees='';
    public $selectOptionsCustomers='';
    #[Validate('required')]
    public $selectedEmployee = null;
    public $currentEmployee = null;
    public $selectedWeek = null;
    public $selectedYear = null;
    public $route = 'week';
    public $populate;
    public $cardsHtml ='';
    protected $listeners = [
        'refresh-week' => '$refresh'
    ];
    public function __constructor(){
        $this->populate = new PopulateController();
        $this->dateTrait =new DateTreatment();
    }
    public function thisWeek(): void
    {
        $dateTrait =new DateTreatment();
        $this->numWeek =  $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        $this->year = now()->format('Y');
        $this->traitNullVars();
    }
    public function backWeek(): void
    {
        $date = new DateTreatment();
        if(($this->numWeek -1) <= 0 ){
            $this->numWeek = 52;
            $this->year--;

        }else{
            $this->numWeek--;
        }
        $this->traitNullVars();

    }
    public function forwardWeek(): void
    {
        if(($this->numWeek +1) > 52 ){
            $this->numWeek = 1;
            $this->year++;
        }else{
            $this->numWeek++;
        }
        $this->traitNullVars();
    }
    #[Computed]
    public function dataCard(){

        $this->traitNullVars();
        $employees =  Populate::employeeFilter();
        $filteredWeekGroup = [];
        $employeesClass = new Employee();
        foreach ($employees as $row){
            $filteredWeekGroup[$row->name] = $employeesClass->servicesFromWeekNumber($row->id,$this->numWeek,$this->year);;

        }
        /** Rendering HTML elements in server side SSR */
        return $this->createResidentialCard($filteredWeekGroup,$this->numWeek,$this->year);
    }
    public function confirmService($id): void
    {
        //TODO: implementar logica para confirmar serviço
        $curentService = Service::find($id);
        if ($curentService->confirmed === 1) {
            $curentService->confirmed = 0;
        } else {
            $curentService->confirmed = 1;
        }
        $curentService->save();
        $this->dispatch('refresh-week');
        if($curentService->confirmed === 1){
            $this->dispatch('toast-alert',icon:'success',message:"Service has been confirmed!!!") ;
        }else{
            $this->dispatch('toast-alert',icon:'warning', message:"Service has been decommitted!!!") ;
        }
    }
    public function mount(){

        if($this->from and ($this->numWeek === null)){
            $dateTrait = new DateTreatment();
            $this->numWeek = $dateTrait->numberWeekByDay(Carbon::create($this->from)->nextWeekday()->format('Y-m-d'));
        }
        if ($this->selectedWeek === null){$this->selectedWeek = $this->numWeek;}
        if($this->selectedYear === null){$this->selectedYear = $this->year;}



        $this->traitNullVars();
        $this->selectOptionsEmployees = Populate::employeeFilter();
        $this->selectOptionsCustomers = Populate::customerFilter();

    }

    public function render()
    {

        return view('livewire.residential.week')
            ->extends('layouts.app');

    }
}
