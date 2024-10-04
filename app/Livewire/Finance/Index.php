<?php

namespace App\Livewire\Finance;

use AllowDynamicProperties;
use App\Helpers\Finance\FinanceTrait;
use App\Models\Config;
use App\Models\Employee;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use function Symfony\Component\String\u;

#[AllowDynamicProperties] class Index extends Component
{
    use WithPagination;
    use FinanceTrait;
    protected $listeners = ['refresh-index' => '$refresh'];

//    public $employees;
//    public $employees_services;
    //public $dateTrait = "";
    public $nun_reg_pages = 5;
    public $numWeek = null;
    public $data = null;
    public $from ='';
    public $till ='';

    public $allEmployees = null;
    public $employees = null;
    public $employees_services = null;
    public $total_services = null;
    public $selectedEmployee = null;
    public $selectedWeek = null;
    public $selectedYear = null;

    public $year = null;
    public $previousYear=0;
    public $nextYear=0;
    public $previousWeek=0;
    public $nextWeek=0;
    public function thisWeek(): void
    {
        $dateTrait =new DateTreatment();
        $this->numWeek =  $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        $this->year = now()->format('Y');
        $this->mount();
        $this->render();
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
        $this->mount($this->numWeek,$this->year);
        $this->render();
        $this->dispatch('refresh-index');

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
        $this->mount($this->numWeek,$this->year);
        $this->render();
        $this->dispatch('refresh-index');
        //dd($this->allEmployees);
    }
    #[NoReturn] public function selectWeek(): void
    {


        dd($this->numWeek,$this->year,$this->selectedEmployee);
    }
    public function populate($nunWeek =null,$year=null): void
    {
        $date = new DateTreatment();
        if($nunWeek === null){
            $this->numWeek = $date->numberWeekByDay(now()->timezone('America/New_York')->format('Y-m-d'));
        }else{
            $this->numWeek = $nunWeek;
        }
        if ($year === null){
            $this->year = now()->format('Y');
        }else{
            $this->year = $year;
        }
        $week = $date->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Saturday'])->format('m/d/Y') ;
        $this->previousYear = $this->year - 1;
        $this->nextYear = $this->year + 1;
        $this->previousWeek = $this->numWeek - 1;


        //dd($this->year);
        $userConfigs = Config::select()->where('user_id','=',Auth::user()->id)->first();
        //dd( $userConfigs->nun_reg_pages );
        $this->nun_reg_pages = $userConfigs->nun_reg_pages;
        $this->allEmployees = Employee::select()
            ->where('status','=',"ACTIVE")
            ->where('type','=',"RESIDENTIAL")
            ->orderBy('name')
            ->get();

        if($this->data === null) $this->data = $this->getData($nunWeek,$year);
        $this->allEmployees = $this->data['allEmployees'];
        $this->employees_services = $this->data['employees_services'];
        $this->employees = $this->data['employees'];
        $this->total_services = $this->data['total_services'];
    }
    public function mount($nunWeek = null,$year = null)
    {

        $this->populate($nunWeek,$year);

    }
    public function render($data = null)
    {
        return view('livewire.finance.index')
                ->extends('layouts.app');
    }
}
