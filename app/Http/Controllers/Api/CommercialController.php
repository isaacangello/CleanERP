<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\numberweek;
use App\Http\Controllers\year;
use App\Models\Customer;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Treatment\DateTreatment;

class CommercialController extends Controller
{

    public DateTreatment $date;
    public Employee $employee;
    public Customer $customer;
    public function __construct()
    {
        $this->date = new DateTreatment();
        $this->employee = new Employee();
        $this->customer = new Customer();
    }

    //
    public function index(Request $request, $msg = null)
    {
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
            $numweek = $request->numberweek;
            $weekarr = $this->date->getWeekByNumberWeek($request->numberweek,$year);
            $this->from = $weekarr['Monday'];
            $this->till = $weekarr['Sunday'];
            //dd($weekarr);
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
            $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeekNumber($row->id,$numweek);;
        }

//        dd($filteredWeekGroup);
        // mensagem do formulario
        if($request->msg !== null and $msg === null ){
            $msg = $request->msg;
        }

       return response()->json(
           [
               'view' => 'commercial.schedule',
               'dataArr' => $filteredWeekGroup,
               'weekArr' => $weekarr,
               'numWeek' => $numweek,
               'year' => $year,
               'employeesCol' => $this->employee->all()->sortBy('name'),
               'customersCol' => $this->customer->all()->sortBy('name'),
               'msg' => $msg,
           ],
           200
       );
    }
    public function store(Request $request){
        $response = [
            'message' => 'Method store Commercial controller',
            'data' => $request->all()

        ];
        response()->json($response,200);
    }
}
