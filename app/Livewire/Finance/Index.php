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
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use function Laravel\Prompts\select;
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
    #[Url]
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
    //public $dateTrait = null;
    #[Url]
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
        //$this->dispatch('reloadMaterializeSelects');
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
        //$this->dispatch('reloadMaterializeSelects');

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
    }
    #[NoReturn] public function selectWeek(): void
    {

        //dd($this->selectedWeek,$this->selectedYear,$this->selectedEmployee);
        $this->numWeek = $this->selectedWeek;
        $this->year = $this->selectedYear;
    }
########################################################################################################################
    ############################################################# populate
########################################################################################################################
    /**
     * @param $nunWeek
     * @param $year
     * @return void
     */
    #[Computed]
    public function populate(): array
    {
        $date = new DateTreatment();
        if($this->numWeek === null){
            $this->numWeek = $date->numberWeekByDay(now()->format('Y-m-d'));
        }
        if ($this->year === null){
            $this->year = now()->format('Y');
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
        //var_dump($this->numWeek);
        return $this->getData($this->numWeek,$this->year);
    }
########################################################################################################################
    ############################################################# mount
########################################################################################################################
    /**
     * @return void
     */
    public function mount(): void
    {
        $dateTrait = new DateTreatment();
        $this->selectedWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        $this->selectedYear = now()->format('Y');
    }
########################################################################################################################
    ############################################################# render
########################################################################################################################
    /**
     * @param $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function render($data = null)
    {
        return view('livewire.finance.index')
                ->extends('layouts.app');
    }
}
