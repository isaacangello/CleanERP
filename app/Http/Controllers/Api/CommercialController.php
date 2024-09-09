<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Funcs;
use App\Http\Controllers\Controller;
use App\Http\Controllers\numberweek;
use App\Http\Controllers\year;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Treatment\DateTreatment;
use Illuminate\Support\Facades\DB;

class CommercialController extends Controller
{

    public DateTreatment $date;
    public Employee $employee;
    public Customer $customer;
    public Schedule $schedule;
    public function __construct()
    {
        $this->date = new DateTreatment();
        $this->employee = new Employee();
        $this->customer = new Customer();
        $this->schedule =  new Schedule();
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
        $data = $this->schedule->with('customer','employee')->whereDate('schedule_date','>=' , $this->from )->whereDate('schedule_date','<=' , $this->till )->orderBy('schedule_date')->get();
//        dd($this->from);
        $div_exemple = "
        <div class='card green darken-3 white-text'>
            <div class='card-content card-content-min'>
                <span class='card-title font-12'> dayName - day </span>
                <p>
                <table class='table-home green darken-3 centered'>
                    <tbody>
                            <tr class='yellow-row'><td>&nbsp;</td></tr>
                            <tr class='yellow-row'><td>&nbsp;</td></tr>
                            <tr class='yellow-row'><td>&nbsp;</td></tr>
                    </tbody>
                </table>

                </p>
            </div>
        </div>

        
        ";
        $textRowTd = ['text1','text2','text3'];

        //dd($card);

        $schedulesPerDay = [];
//        dd($data);
        foreach ($data as $item){
//            echo $item->schedule_date."<br>";
            $scheduleDateCarbon = Carbon::create($item->schedule_date);
            if($scheduleDateCarbon->isMonday()){
                $schedulesPerDay['Monday'][] =  $item;
            }
            if($scheduleDateCarbon->isTuesday()){
                $schedulesPerDay['Tuesday'][] =  $item;
            }
            if($scheduleDateCarbon->isWednesday()){
                $schedulesPerDay['Wednesday'][] =  $item;
            }
            if($scheduleDateCarbon->isThursday()){
                $schedulesPerDay['Thursday'][] =  $item;
            }
            if($scheduleDateCarbon->isFriday()){
                $schedulesPerDay['Friday'][] =  $item;
            }
        }
        $schedulesPerDayAndEmployee = [];
        //dd(array_key_exists()$schedulesPerDay['Friday']);
        foreach ($schedulesPerDay as $dayName => $dataSchedule){
            $schedulesPerDayAndEmployee[$dayName] = [];
            foreach ($dataSchedule as $data){
                $schedulesPerDayAndEmployee[$dayName][$data->employee->name][] = $data;
            }
        }
        //dd($schedulesPerDayAndEmployee);
        $cards = '';
        foreach ($schedulesPerDayAndEmployee as $dayName => $dataSchedule){
            if($dayName != "Saturday" and $dayName != "Sunday" ){
                $textRowTd = [];
                //dd($dataSchedule);
                $cards .=  Funcs::createCommercialCard($dataSchedule, "$dayName - ".$weekarr[$dayName]);
            }
        }
       return response()->json(
           [
               'view' => 'commercial.schedule',
                'cards' => $cards,
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
    public function show($id)
    {
        $returned = $this->schedule->with('customer','employee','control')->find($id);
        return response()->json($returned,200);
    }
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate($this->schedule->rules);
        $response = $this->schedule->create(
            [
                'customer_id'=>$request->customer_id,
                'employee_id'=> $request->employee1_id,
                'schedule_date' =>Funcs::dateTimeToDB($request->get('schedule_date'),$request->get('schedule_time')),
                'notes' =>$request->notes,
                'instructions' =>$request->instructions,
                'denomination' =>$request->denomination,
                'who_saved' => $request->who_saved.":".$request->who_saved_id,
                'loop' => json_encode($request->loop)


            ]
        );

        return response()->json($response,200);
    }

    public function update($id, Request $req)
    {
        //dd($req);
        $dynamic_rules = array();
        foreach ($this->schedule->rules as $input => $rule ){
            if(array_key_exists($input, $req->all())){
                $dynamic_rules[$input] = $rule;
            }
        }
        $req->validate($dynamic_rules);
        $result =  $this->schedule->find($id);
        $valOld = "next";
        switch ($req->fieldName){
            case'drive_licence': $valOld = $result->drive_licence;
            case'key': $valOld = $result->key;
            case'more_girl': $valOld = $result->more_girl;
            case'gate_code': $valOld = $result->gate_code;
            default: $val_update = $req->value;
        }
        if($valOld != "next"){
            if($valOld=== 0){$val_update = 1;}else{$val_update = 0;}
        }
        $result->update([
            $req->fieldName => $val_update
        ]);
        $result->save();
        return response()->json(['_token' => $req->_token,'fieldName' =>$req->fieldName,'value' => $val_update, $req->fieldName => $valOld ]);
    }
    public function query(Request $request,$id, $fields){
        $firstParam = explode(':', $fields)[0];
        $queryString = explode(':', $fields)[1];
        if($firstParam === "with"){
            if($fields){
                $service = $this->schedule->selectRaw($queryString)->with('customer','employee', 'employee2','control')->find($id);
                $status = 206;
            }
        }else{
            $service = $this->schedule->selectRaw($queryString)->find($id);
            $status = 206;
        }
        return response()->json($service,$status);
    }


}
