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

        /**
         * OLLAMA CODE
         */
//        $schedules = DB::table('schedules')
//            ->join('customers', 'schedules.customer_id', '=', 'customers.id')
//            ->join('employees', 'schedules.employee_id', '=', 'employees.id')
//            ->select(
//                'schedules.*',
//                DB::raw('DAYNAME(schedule_date) as day_of_week'),
//                'customers.name as customer_name',
//                'employees.name as employee_name'
//            )
//            ->whereNull('schedules.deleted_at')
//            ->get();
//
//// Agora, você pode agrupar os registros pelo dia da semana:
//        $groupedSchedules = $schedules->groupBy(function ($item) {
//            return Carbon::parse($item->schedule_date)->dayOfWeek;
//        });

//        dd($filteredWeekGroup);
        // mensagem do formulario
        if($request->msg !== null and $msg === null ){
            $msg = $request->msg;
        }
        $data = $this->schedule->with('customer','employee')->get();
        $groupedSchedules = $data->groupBy(function ($item) {
            return Carbon::parse($item->schedule_date)->dayOfWeek;
        });
        $schedulesPerDay = [];
        foreach ($groupedSchedules as $item){
            $scheduleDateCarbon = Carbon::create($item->schedule_date);
            if($scheduleDateCarbon->isMonday()){
                $schedulesPerDay['monday'][] =  $item->toArray();
            }
        }
       return response()->json(
           [
//               'view' => 'commercial.schedule',
               'dataArr' =>  $groupedSchedules,
//               'weekArr' => $weekarr,
//               'numWeek' => $numweek,
//               'year' => $year,
//               'employeesCol' => $this->employee->all()->sortBy('name'),
//               'customersCol' => $this->customer->all()->sortBy('name'),
//               'msg' => $msg,
           ],
           200
       );
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
}
