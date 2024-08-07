<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Helpers\Funcs;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use DOMElement;
use DOMDocument;
use Illuminate\Http\Request;
use App\Treatment\DateTreatment;
use Spatie\Html\Html;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Element;
#[AllowDynamicProperties] class CommercialController extends Controller
{

    public DateTreatment $date;
    public Employee $employee;
    public Customer $customer;
    public Schedule $schedule;
    public Html $html;
    public function __construct(Request $request)
    {
        $this->date = new DateTreatment();
        $this->employee = new Employee();
        $this->customer = new Customer();
        $this->schedule = new Schedule();
        $this->html = new Html($request);
    }

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
        $data = $this->schedule->with('customer','employee')
            ->whereDate('schedule_date','>=' , $this->from )
            ->whereDate('schedule_date','<=' , $this->till )
            ->orderBy('schedule_date')
            ->get();
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


        return view('commercial.schedule',
            [
                'dataArr' => $schedulesPerDay,
                'weekArr' => $weekarr,
                'numWeek' => $numweek,
                'cards' => $cards,
                'year' => $year,
                'employeesCol' => $this->employee->all()->sortBy('name'),
                'customersCol' => $this->customer->all()->sortBy('name'),
                'msg' => $msg,
            ]
        );
    }
}
//
