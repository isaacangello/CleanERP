<?php

namespace App\Livewire\Finance;

use AllowDynamicProperties;
use App\Models\Config;
use App\Models\Employee;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Http\Controllers\FinanceController;
use Livewire\WithPagination;

#[AllowDynamicProperties] class Index extends Component
{
    use WithPagination;
    protected $listeners = ['refreshTable' => '$refresh'];

//    public $employees;
//    public $employees_services;
    public $nun_reg_pages = 5;
    public $numWeek = -1;
    public $year = -1;
    public $previousYear=0;
    public $nextYear=0;
    public $previousWeek=0;
    public $nextWeek=0;
    public function thisWeek()
    {
        //dd('entrou');
      $this->mount();
      $this->render();
      $this->dispatch('refreshTable')->self();
    }
    public function forwardWeek($numWeek, $year){

        $this->mount();
        $this->render();
        $this->dispatch('refreshTable')->self();
    }
    public function selectedWeek($numWeek, $year){
        $this->numWeek = $numWeek;
        $this->year = $year;
        $this->mount();
        $this->render();
        $this->dispatch('refreshTable')->self();
    }
    public function getData($day = null)
    {
        if($day === null)$day = Carbon::now()->timezone("America/New_York")->format("Y-m-d");
        $model = new Employee();
        $finance = new FinanceController();
        $date = new DateTreatment();
        $all_employees = $model->select()->where('status' , '=', "ACTIVE")
            ->where('type', '=',"RESIDENTIAL" )->orderBy('name')->get()->toArray();

        $collection_employees = $model->select()->where('status' , '=', "ACTIVE")
            ->where('type', '=',"RESIDENTIAL" )->orderBy('name')->paginate($this->nun_reg_pages)->toArray();
        $array_temp = $finance->getEmployeeServices(new DateTreatment());
        $dateFrom = $date->GetMondaySartuday($day);
        $cem = $finance->total_price_services_period($dateFrom['monday'],$dateFrom['saturday']);
        $total_services = [
            'cem' => $cem,
            'setenta' => ($cem*0.7),
            'trinta' => ($cem*0.3)
        ];

        return[
            'allEmployees' => $all_employees,
            'employees' => $collection_employees,
            'employees_services' => $array_temp,
            'total_services' => $total_services,
            'dateFrom' => $dateFrom,
            'numWeek' => $this->numWeek,
            'year' => $this->year,
            'previousYear' => $this->previousYear,
            'nextYear' => $this->nextYear,
            'previousWeek' => $this->previousWeek,
            'nextWeek' => $this->nextWeek,
            'nun_reg_pages' => $this->nun_reg_pages,
        ];
    }
    public function mount($day = null)
    {
        if($day === null)$day = Carbon::now()->timezone("America/New_York")->format("Y-m-d");
        $date = new DateTreatment();
        if ($this->numWeek < 0) $this->numWeek = $date->numberWeekByday(now()->timezone('America/New_York')->format('Y-m-d'));
        //dd($this->numWeek);
        if ($this->year < 0) $this->year = date('Y');

        $this->previousYear = $this->year - 1;
        $this->nextYear = $this->year + 1;
        if ($this->previousWeek === 0){
            $this->previousWeek = $date->numberWeekByday($date->GetMondaySartuday($day)['monday']) - 1;
        }else{
            $this->previousWeek = $this->previousWeek - 1;
        }

        //dd($this->year);
        $userConfigs = Config::select()->where('user_id','=',Auth::user()->id)->first();
        //dd( $userConfigs->nun_reg_pages );
        $this->nun_reg_pages = $userConfigs->nun_reg_pages;


    }
    public function render($data = null)
    {
//        dd($cem);
        if($data === null) $data = $this->getData();

        //dd($all_employees);
        return view('livewire.finance.index',
                        [
                            'allEmployees' => $data['allEmployees'],
                            'employees' => $data['employees'],
                            'employees_services' => $data['employees_services'],
                            'total_services' => $data['total_services']
                        ]
                )
                ->extends('layouts.app');
    }
}
