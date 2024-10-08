<?php

namespace App\Livewire\Finance;

use App\Helpers\Finance\FinanceTrait;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Detailer extends Component
{
    use FinanceTrait;
    public $id;
    public $from;
    public $till;
    public $numWeek = null;
    public $selectedEmployee = null;
    public $selectedWeek = null;
    public $selectedYear = null;
    public function thisWeek(): void
    {
        $dateTrait =new DateTreatment();
        $this->numWeek =  $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        $this->year = now()->format('Y');
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
        $week = $date->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Saturday'])->format('m/d/Y') ;

    }
    public function forwardWeek(): void
    {
        if(($this->numWeek +1) > 52 ){
            $this->numWeek = 1;
            $this->year++;
        }else{
            $this->numWeek++;
        }
        $date = new DateTreatment();
        $week = $date->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Saturday'])->format('m/d/Y') ;
        $this->dispatch('reloadSelects');
    }
    #[NoReturn] public function selectWeek(): void
    {


        $this->numWeek = $this->selectedWeek;
        $this->year = $this->selectedYear;
        $this->dispatch('reloadSelects');
    }
###
    public function mount(): void
    {
        $dateTrait = new DateTreatment();
        $this->numWeek = $dateTrait->numberWeekByDay($this->from);
        $this->dispatch('reloadSelects');
    }

    #[Computed]
    public function getData()
    {
    // Fetch data for the given week and employee
        return $this->servicesEmployee($this->id,$this->from,$this->till);
    }
    #[Computed]
    public function allEmployees(){
        return $this->getEmployees();
    }
    public function render()
    {
        return view('livewire.finance.detailer')->extends('layouts.app');
    }
}
