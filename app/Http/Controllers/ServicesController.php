<?php

namespace App\Http\Controllers;

//use App\View\Components\customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Employee;
use \App\Models\Customer;
use App\Treatment\DateTreatment;
use Carbon\CarbonPeriod;
class ServicesController extends Controller
{

    private Service $service;
    private DateTreatment $date;
    private Employee $employee;
    private Customer $customer;
    private mixed $from;
    private mixed $till;
    private string $today;

    public function __construct(Service $service,DateTreatment $date, Employee $employee,Customer $customer)
    {
        $this->service = $service;
        $this->date = $date;
        $this->employee = $employee;
        $this->customer = $customer;
        $this->today = now()->format('Y-m-d');
    }

    public function home(Request $request){
        /**
         * Tratando dados recebidos no request ano e numero da semana
         * @param year
         * @param numberweek
         */
        if (isset($request->year)){$year = $request->year;}else{$year = 'current';}
        /**
         * Verificando tamanho das semanas do ano
         *  casso a sentença seja falsa e retornadado um array com a semana atual
         *  @retunn array
         */
        if(isset($request->numberweek) and intval($request->numberweek) >=1 and intval($request->numberweek) <=52 ){
//            dd($request->numberweek);
            $weekarr = $this->date->getWeekByNumberWeek($request->numberweek,$year);
            $this->from = $weekarr['Monday'];
            $this->till = $weekarr['Sunday'];
        }else{

            $numweek = $this->date->numberWeekByday(now()->format('Y-m-d'));
            $weekarr = $this->date->getWeekByNumberWeek($numweek,$year);
            $this->from = $weekarr['Monday'];
            $this->till = $weekarr['Sunday'];
        }
        /**
         * Montado dados para tela
         *  percorrendo o array de datas da semana retornada e montando array de dados
         * com os serviços da semana atual, filtrados por employee
         */

                    $filteredWeekGroup= [];


//
//            dd($array_week);
//            dd($filtered);
            $weekarr['Monday'] = Carbon::create($weekarr['Monday'])->format('m/d/Y');
            $weekarr['Tuesday'] = Carbon::create($weekarr['Tuesday'])->format('m/d/Y');
            $weekarr['Wednesday'] = Carbon::create($weekarr['Wednesday'])->format('m/d/Y');
            $weekarr['Thursday'] = Carbon::create($weekarr['Thursday'])->format('m/d/Y');
            $weekarr['Friday'] = Carbon::create($weekarr['Friday'])->format('m/d/Y');
            $weekarr['Saturday'] = Carbon::create($weekarr['Saturday'])->format('m/d/Y');
            $weekarr['Sunday'] = Carbon::create($weekarr['Sunday'])->format('m/d/Y');

            $employees =  $this->employee->all()->sortBy('name');

            foreach ($employees as $row){
                $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeeknumber($row->id,$this->date->numberWeekByday(now()->format('Y-m-d')));;
            }

//        dd($filteredWeekGroup);


        return view('home',
        [
           'dataArr' => $filteredWeekGroup,
            'weekArr' => $weekarr,
            'numWeek' => $numweek,
            'employeesCol' => $this->employee->all()->sortBy('name'),
            'customersCol' => $this->customer->all()->sortBy('name'),
        ]);
    }

    


}
