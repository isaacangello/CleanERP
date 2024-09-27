<?php

namespace App\Livewire\Finance;

use AllowDynamicProperties;
use App\Models\Config;
use App\Models\Employee;
use App\Treatment\DateTreatment;
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
    public $numWeek = null;
    public $year = null;
    public $previousYear=0;
    public $nextYear=0;
    public $previousWeek=0;
    public $nextWeek=0;

    public function mount()
    {

        $date = new DateTreatment();
        if ($this->numWeek === null) $this->numWeek = $date->numberWeekByday(now()->format('Y-m-d'));
        //dd($this->numWeek);
        if ($this->year === null) $this->year = date('Y');

        $this->previousYear = $this->year - 1;
        $this->nextYear = $this->year + 1;
        if ($this->previousWeek === 0){
            $this->previousWeek = $date->numberWeekByday($date->GetMondaySartuday()['monday']) - 1;
        }else{
            $this->previousWeek = $this->previousWeek - 1;
        }

        //dd($this->year);
        $userConfigs = Config::select()->where('user_id','=',Auth::user()->id)->first();
        //dd( $userConfigs->nun_reg_pages );
        $this->nun_reg_pages = $userConfigs->nun_reg_pages;


    }
    public function render()
    {
        $model = new Employee();
        $finance = new FinanceController();
        $date = new DateTreatment();
        $all_employees = $model->select()->where('status' , '=', "ACTIVE")
            ->where('type', '=',"RESIDENTIAL" )->orderBy('name')->get()->toArray();
        $collection_employees = $model->select()->where('status' , '=', "ACTIVE")
            ->where('type', '=',"RESIDENTIAL" )->orderBy('name')->paginate($this->nun_reg_pages)->toArray();
        $array_temp = $finance->getEmployeeServices(new DateTreatment());
        $dateFrom = $date->GetMondaySartuday();
        $cem = $finance->total_price_services_period($dateFrom['monday'],$dateFrom['saturday']);
//        dd($cem);
        $total_services = [
            'cem' => $cem,
            'setenta' => ($cem*0.7),
            'trinta' => ($cem*0.3)
        ];
        //dd($all_employees);
        return view('livewire.finance.index',
                        [
                            'allEmployees' => $all_employees,
                            'employees' => $collection_employees,
                            'employees_services' => $array_temp,
                            'total_services' => $total_services
                        ]
                )
                ->extends('layouts.app');
    }
}
