<?php

namespace App\Livewire\Finance;

use App\Helpers\Finance\FinanceTrait;
use App\Models\Employee;
use App\Treatment\DateTreatment;
use http\Env\Request;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class Detailer extends Component
{
    use FinanceTrait;
    #[Url]
    public $id;
    public $from;
    public $till;
    public $numWeek = null;
    public $year = null;
    public $selectedEmployee = null;
    public $currentEmployee = null;
    public $selectedWeek = null;
    public $selectedYear = null;
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
    #[NoReturn] public function selectWeek(): void
    {

        $this->numWeek = $this->selectedWeek;
        $this->year = $this->selectedYear;

    }
###
    public function mount(): void
    {
        if ($this->id){
            $this->currentEmployee = Employee::find($this->id);
        }
        if($this->from and ($this->numWeek === null)){
            $dateTrait = new DateTreatment();
            $this->numWeek = $dateTrait->numberWeekByDay(Carbon::create($this->from)->nextWeekday()->format('Y-m-d'));
        }

        $this->traitNullVars();
    }

    #[Computed]
    public function Data(): \Illuminate\Support\Collection
    {
    // Fetch data for the given week and employee
//        dd($this->servicesEmployee($this->id,$this->from,$this->till));
        return $this->servicesEmployee($this->id,$this->from,$this->till);
    }
    #[Computed]
    public function allEmployees(): \Illuminate\Support\Collection
    {
        return $this->getEmployees();
    }
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('livewire.finance.detailer')->extends('layouts.app');
    }
    public function searchServices(){
        //Search services by employee, from, till
        //dd($this->servicesEmployee($this->id,$this->from,$this->till));
        return redirect()->route('finances.detailer', ['id' => $this->selectedEmployee, 'from' => Carbon::create($this->from)->format("Y-m-d"), 'till' => Carbon::create($this->till)->format("Y-m-d")]);
    }
}
