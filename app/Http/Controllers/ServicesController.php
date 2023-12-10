<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Employee;
use App\Treatment\DateTreatment;
use Carbon\CarbonPeriod;
class ServicesController extends Controller
{

    private Service $service;
    private DateTreatment $date;
    private Employee $employee;

    public function __construct(Service $service,DateTreatment $date, Employee $employee)
    {
        $this->service = $service;
        $this->date = $date;
        $this->employee = $employee;
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

        }else{

            $numweek = $this->date->numberWeekByday(now()->format('Y-m-d'));
            $weekarr = $this->date->getWeekByNumberWeek($numweek,$year);
        }
        /**
         * Montado dados para tela
         *  percorrendo o array de datas da semana retornada e montando array de dados
         * com os serviços da semana atual, filtrados por employee
         */
        $servicesArr = [];

            $servicesArr = $this->employee->servicesFromPeriod($weekarr['Monday'],$weekarr['Sunday']);
            $filtered = [];
            $array_week['Monday']= [];$array_week['Tuesday']= [];$array_week['Wednesday']= [];$array_week['Thursday']= [];$array_week['Friday']= [];$array_week['Saturday']= [];
//            dd($servicesArr->toArray());
            foreach ($servicesArr->toArray() as $key => $row){
                $c=0;
                $array_temp = [];


                foreach ($row as $key2 => $items){
//                        var_dump($items->service_date)."<br>";
                    $carbon_date = Carbon::create($items->service_date);
                    if($carbon_date->isMonday()){
                        $weekDay="Monday";
                        $array_temp2= [
                            'service_id' => $items->service_id,
                            'cust_id' => $items->cust_id,
                            'emp_id' => $items->emp_id,
                            'service_date' => $items->service_date,
                            'period' => $items->period,
                            'who_saved' => $items->who_saved,
                            'cust_name' => $items->cust_name,
                            'emp_name' => $items->emp_name,
                        ];
                        $array_week['Monday'][$c]=$array_temp2;

                    }
                    if($carbon_date->isTuesday()){
                        $weekDay="Tuesday";
                        $array_temp2= [
                            'service_id' => $items->service_id,
                            'cust_id' => $items->cust_id,
                            'emp_id' => $items->emp_id,
                            'service_date' => $items->service_date,
                            'period' => $items->period,
                            'who_saved' => $items->who_saved,
                            'cust_name' => $items->cust_name,
                            'emp_name' => $items->emp_name,
                        ];
                        $array_week['Tuesday'][$c]=$array_temp2;
                    }
                    if($carbon_date->isWednesday()){
                        $weekDay="Wednesday";
                        $array_temp2= [
                            'service_id' => $items->service_id,
                            'cust_id' => $items->cust_id,
                            'emp_id' => $items->emp_id,
                            'service_date' => $items->service_date,
                            'period' => $items->period,
                            'who_saved' => $items->who_saved,
                            'cust_name' => $items->cust_name,
                            'emp_name' => $items->emp_name,
                        ];
                       $array_week['Wednesday'][$c] = $array_temp2;
                    }
                    if($carbon_date->isThursday()){
                        $weekDay="Thursday";
                        $array_temp2= [
                            'service_id' => $items->service_id,
                            'cust_id' => $items->cust_id,
                            'emp_id' => $items->emp_id,
                            'service_date' => $items->service_date,
                            'period' => $items->period,
                            'who_saved' => $items->who_saved,
                            'cust_name' => $items->cust_name,
                            'emp_name' => $items->emp_name,
                        ];
                        $array_week['Thursday'][$c]=$array_temp2;
                    }
                    if($carbon_date->isFriday()){
                        $weekDay="Friday";
                        $array_temp2= [
                            'service_id' => $items->service_id,
                            'cust_id' => $items->cust_id,
                            'emp_id' => $items->emp_id,
                            'service_date' => $items->service_date,
                            'period' => $items->period,
                            'who_saved' => $items->who_saved,
                            'cust_name' => $items->cust_name,
                            'emp_name' => $items->emp_name,
                        ];
                         $array_week['Friday'][$c]=$array_temp2;
                    }
                    if($carbon_date->isSaturday()){
                        $weekDay="Saturday";
                        $array_temp2= [
                            'service_id' => $items->service_id,
                            'cust_id' => $items->cust_id,
                            'emp_id' => $items->emp_id,
                            'service_date' => $items->service_date,
                            'period' => $items->period,
                            'who_saved' => $items->who_saved,
                            'cust_name' => $items->cust_name,
                            'emp_name' => $items->emp_name,
                        ];
                         $array_week['Saturday'][$c]=$array_temp2;
                    }
                    $array_temp[$c]['service_id']= $items->service_id;
                    $array_temp[$c]['cust_id']= $items->cust_id;
                    $array_temp[$c]['emp_id']= $items->emp_id;
                    $array_temp[$c]['service_date']= $items->service_date;
                    $array_temp[$c]['period']= $items->period;
                    $array_temp[$c]['who_saved']= $items->who_saved;
                    $array_temp[$c]['cust_name']= $items->cust_name;
                    $array_temp[$c]['emp_name']= $items->emp_name;
                    $array_temp[$c]['weekDay']= $weekDay;
                    $c++;
                }

//                    echo"<hr>";
                    $array_sort = collect($array_temp)->sortBy('service_date')->toArray();
                    if(array_key_exists($key,$filtered)){
                          array_push($filtered[$key],$array_sort)  ;
                    }else{
                        $filtered[$key] = $array_sort;
                    }
            }


            dd($array_week);
//            dd($filtered);


        return view('home',
        [
           'weekarr' => $filtered,
        ]);
    }
}
