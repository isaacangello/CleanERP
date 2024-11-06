<?php

namespace App\Livewire\Finance;

use App\Helpers\Finance\FinanceTrait;
use App\Helpers\Funcs;
use App\Livewire\RepeatTrait;
use App\Models\Employee;
use App\Models\Service;
use App\Treatment\DateTreatment;
use http\Env\Request;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Detailer extends Component
{
    use FinanceTrait;
    use RepeatTrait;
    #[Url]
    public $id;
    public $from;
    public $till;
    public $numWeek = null;
    public $year = null;
    public $notesOpen = false;
    public $modalKey = null;
    public $modalOpen = false;
    public $modalMarkedFrequency = null;
    public $modal_dates = null;
    public $financeNotes = null;
    public $frequencyStrings = [
        'ONE'=>'Eventual',
        'WEK'=>'Weekly',
        'BIW'=>'Biweekly',
        'THR'=>'Triweekly',
        'MON'=>'Monthly',
        ];
    #[Validate('required')]
    public $selectedEmployee = null;
    public $currentEmployee = null;
    public $selectedWeek = null;
    public $selectedYear = null;

    public function toggleModal(): void
    {
        $this->modalOpen = !$this->modalOpen;
    }
    public function openAndPopulateModal($key): void
    {
        $this->modalKey = $key;
        //dd($this->Data()[$key]);
        $this->financeNotes = $this->Data()[$key]->finance_notes ;
        $result = $this->searchServiceCycleById($this->data[$key]->id);
        //var_dump($result);
        if($result){
            $dates = explode(',',$result->dates);
            $this->modal_dates = "";
            $c=0;
            foreach ($dates as $date){
                $this->modal_dates .= "<span class='".Funcs::altClass($c,['text-gray-500',''])."'>".Carbon::create($date)->format('m/d/Y')."</span> <span class='text-yellow-800 px-1.5'>  |  </span>    ";
                $c++;
                if($c === 6){
                    $this->modal_dates .= "<br>";
                    $c = 0;
                }

            }
            $this->modalMarkedFrequency =  $this->frequencyStrings[strtoupper($result->frequency)];

        }else{
            $this->modal_dates = "No repeat found";
            $this->modalMarkedFrequency = "No Frequency found";
        }

        $this->modalOpen = true;

    }
    public function saveFinanceNotes(): void
    {
        $this->validate([
            'financeNotes' => 'nullable|string'
        ]);
        $service = Service::find($this->data[$this->modalKey]->id);
        $service->finance_notes = $this->financeNotes??" ";
        $service->save();
        //$this->modalOpen = false;
        $this->dispatch('toast-alert', icon: 'success', message: 'Finance notes saved');
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
        $this->validate();
        if(($this->selectedEmployee === 1) or is_null($this->selectedEmployee)){
            $this->selectedEmployee = $this->currentEmployee->id;
        }
        return redirect()->route('finances.detailer', ['id' => $this->selectedEmployee, 'from' => Carbon::create($this->from)->format("Y-m-d"), 'till' => Carbon::create($this->till)->format("Y-m-d")]);
    }
    public function printReport(){
        //Search services by employee, from, till
        //dd($this->servicesEmployee($this->id,$this->from,$this->till));

        return redirect()->route('finances.report.export',
            ['id' => $this->currentEmployee->id, 'from' => Carbon::create($this->from)->format("Y-m-d"),  'till' => Carbon::create($this->till)->format("Y-m-d"), 'message'=> $this->finance_notes??"&nbsp;" ]
        );
    }

}
