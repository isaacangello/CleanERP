<?php

namespace App\Livewire\Finance;

use AllowDynamicProperties;
use App\Helpers\Finance\FinanceTrait;
use App\Helpers\Funcs;
use App\Models\Config;
use App\Models\Employee;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
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
    public mixed $total_services = null;
    #[Validate('required')]
    public $selectedEmployee = null;
    public $selectedWeek = null;
    public $selectedYear = null;

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
        $date = new DateTreatment();
        $week = $date->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Saturday'])->format('m/d/Y') ;
        $this->dispatch('reloadSelects');
    }
    #[NoReturn] public
    function selectWeek(): void
    {

        $this->numWeek = $this->selectedWeek;
        $this->year = $this->selectedYear;
        $this->dispatch('refresh-index');

    }
########################################################################################################################
    ############################################################# populate
########################################################################################################################
    /**
     * @param $nunWeek
     * @param $year
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    #[Computed]
    public function populate(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $date = new DateTreatment();
        $this->traitNullVars();
        $this->previousYear = $this->year - 1;
        $this->nextYear = $this->year + 1;
        $this->previousWeek = $this->numWeek - 1;


        //dd($this->year);
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
        $this->traitNullVars();

        $this->allEmployees = Employee::select()
            ->where('status','=',"ACTIVE")
            ->where('type','=',"RESIDENTIAL")
            ->orWhere('type','=','RENTALHOUSE')
            ->orderBy('name')
            ->get();

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
        return view('livewire.finance.index');
    }
    public function searchServices()
    {
        $this->validate();
        //Search services by employee, from, till
        if($this->numWeek === 1){
            $this->previousWeek = 52;
            $this->previousYear= $this->year - 1;
        }else{
            $this->previousWeek = $this->numWeek - 1;
            $this->previousYear = $this->year;
        }
        if($this->numWeek === 52){
            $this->nextWeek = 1;
            $this->nextYear = $this->year + 1;
        }

        return redirect()->route('finances.detailer', ['id' => $this->selectedEmployee, 'from' => Carbon::create($this->from)->format("Y-m-d"), 'till' => Carbon::create($this->till)->format("Y-m-d")]);
    }

}
