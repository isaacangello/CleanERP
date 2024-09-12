<?php

namespace App\Http\Controllers\Api;

use AllowDynamicProperties;
use App\Helpers\Funcs;
use App\Http\Controllers\Controller;
use App\Http\Controllers\numberweek;
use App\Http\Controllers\Populate;
use App\Http\Controllers\year;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Treatment\DateTreatment;
use Illuminate\Support\Facades\DB;

#[AllowDynamicProperties] class CommercialController extends Controller
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
    public function buildCard($from,$till,$nunWeek,$year)
    {
        $weekArr = $this->date->getWeekByNumberWeek($nunWeek,$year);

//        dd($filteredWeekGroup);
        $data = $this->schedule->with('customer','employee')->whereDate('schedule_date','>=' , $from )->whereDate('schedule_date','<=' , $till )->orderBy('schedule_date')->get();
//        dd($this->from);

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
                $cards .=  Funcs::createCommercialCard($dataSchedule, "$dayName - ".$weekArr[$dayName]);
            }
        }
        return $cards;
    }
    public function index(Request $request, $msg = null, )
    {
        /**
         * Tratando dados recebidos no request ano e numero da semana
         * @param year
         * @param numberweek
         */
        if (isset($request->year)){$year = $request->year;}else{$year = 'current';}
        // mensagem do formulario
        if($request->msg !== null and $msg === null ){
            $msg = $request->msg;
        }
        /**
         * Verificando tamanho das semanas do ano
         *  casso a sentença seja falsa e retornadado um array com a semana atual
         *  @retunn array
         */
        if(isset($request->numberweek) and intval($request->numberweek) >=1 and intval($request->numberweek) <=52 ){
//            dd($request->numberWeek);
            $numWeek = $request->numberweek;
            $weekArr = $this->date->getWeekByNumberWeek($request->numberweek,$year);
            $this->from = $weekArr['Monday'];
            $this->till = $weekArr['Sunday'];
            //dd($weekArr);
        }else{

            $numWeek = $this->date->numberWeekByday(now()->format('Y-m-d'));
            $weekArr = $this->date->getWeekByNumberWeek($numWeek,$year);
            $this->from = $weekArr['Monday'];
            $this->till = $weekArr['Sunday'];
        }
        /**
         * Montado dados para tela
         *  percorrendo o array de datas da semana retornada e montando array de dados
         * com os serviços da semana atual, filtrados por employee
         */


            $cards = $this->buildCard($this->from,$this->till,$numWeek,$year);

//
//            dd($array_week);
//            dd($filtered);
        $weekArr['Monday'] = Carbon::create($weekArr['Monday'])->format('m/d/Y');
        $weekArr['Tuesday'] = Carbon::create($weekArr['Tuesday'])->format('m/d/Y');
        $weekArr['Wednesday'] = Carbon::create($weekArr['Wednesday'])->format('m/d/Y');
        $weekArr['Thursday'] = Carbon::create($weekArr['Thursday'])->format('m/d/Y');
        $weekArr['Friday'] = Carbon::create($weekArr['Friday'])->format('m/d/Y');
        $weekArr['Saturday'] = Carbon::create($weekArr['Saturday'])->format('m/d/Y');
        $weekArr['Sunday'] = Carbon::create($weekArr['Sunday'])->format('m/d/Y');

        $employees =  Populate::employeeFilter('commercial');


               return response()->json(
                   [
                       'view' => 'commercial.schedule',
                        'cards' => $cards,
                       'weekArr' => $weekArr,
                       'numWeek' => $numWeek,
                       'year' => $year,
                       'employeesCol' => Populate::employeeFilter('commercial','name'),
                       'customersCol' => Populate::customerFilter('commercial','name'),
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
        if(empty($request->denomination)){
            $cust = $this->customer->find($request->customer_id);
            $denomination = $cust->name;
        }else{
            $denomination = $request->denomination;
        }
        $response = $this->schedule->create(
            [
                'customer_id'=>$request->customer_id,
                'employee_id'=> $request->employee_id,
                'schedule_date' =>Funcs::dateTimeToDB($request->get('schedule_date'),$request->get('schedule_time')),
                'notes' =>$request->notes,
                'instructions' =>$request->instructions,
                'denomination' =>$denomination,
                'who_saved' => $request->who_saved.":".$request->who_saved_id,
                'loop' => json_encode($request->loop)


            ]
        );

        return response()->json([$response],201);
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
    public function delete(Request $req)
    {
        if(empty($req->id)){
            return response()->json(['message'=>'service id not found.'],422);
        }
        $schedule = $this->schedule->find($req->id);
        $schedule->delete();

        $employees =  Populate::employeeFilter('commercial','name');
        if(is_numeric($req->numWeek) && $req->numWeek > 0){
            $weekNun = $req->numWeek;
        }else{
            $weekNun = $this->date->numberWeekByday(now()->format('Y-m-d'));
        }
        if(is_numeric($req->year) && $req->year > 0){
            $year = $req->year;
        }else{
            $year = now()->format('Y');
        }
        $week = $this->date->getWeekByNumberWeek($weekNun,$year);
        $html = $this->buildCard($week['Monday'],$week['Friday'],$weekNun,$year);

        return response()->json(['message' =>  'Service has been deleted!', 'html' => $html ],200);

    }


}
