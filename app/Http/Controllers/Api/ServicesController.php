<?php

namespace App\Http\Controllers\Api;

//use App\View\Components\customer;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Employee;
use \App\Models\Customer;
use App\Treatment\DateTreatment;
use Carbon\CarbonPeriod;
use App\Http\Controllers\Controller;
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

    public function home(Request $request, $msg = null){
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
                $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeekNumber($row->id,$this->date->numberWeekByday(now()->format('Y-m-d')));;
            }

//        dd($filteredWeekGroup);

            $msg = session()->get('msg');
//        dd(session()->get('msg'));

        return view('home',
        [
           'dataArr' => $filteredWeekGroup,
            'weekArr' => $weekarr,
            'numWeek' => $numweek,
            'employeesCol' => $this->employee->all()->sortBy('name'),
            'customersCol' => $this->customer->all()->sortBy('name'),
            'msg' => $msg,
        ]);
    }
    public function index(){

    }
    public function show(Request $request, $id){
        $service = $this->service->find($id)->customer();
//        dd($service);
        return response()->json($service,200);
    }

    public function store(Request $req): \Illuminate\Http\JsonResponse
    {
        if($req->all() === null){
            return response()->json(['msg' => 'need data to store.'],404);
        }
        $req->validate($this->service->rules());
        $service_date = Carbon::create($req->service_date." ".$req->service_time)->format('Y-m-d H:i:s');

 //        $req->who_saved_id = intval($req->who_saved_id);
        $return = $this->service->create([
                'customer_id' => $req->customer_id,
                'employee1_id' =>$req->employee1_id,
                'employee2_id'=>$req->employee2_id,
                'service_date'=>$service_date,
                'period'=>$req->period,
                'frequency'=>$req->frequency,
                'notes' => $req->notes,
                'instructions' => $req->instructions,
                'frequency_payment'=>$req->frequency_payment,
                'payment'=>$req->payment,
                'who_saved'=>$req->who_saved,
                'price'=>$req->price,
                'who_saved_id'=>$req->who_saved_id,
            ]
        );
        return response()->json(['message' => "Service has been scheduled on date $req->service_date, $req->service_time"],201);
    }
    public function update(Request $req,$id){
        if($req->all() === null){
            return response()->json(['msg' => 'need data to update.'],404);
        }
        $service = $this->service->find($id);
        if($req->method() === 'PATCH'){
            $dynamic_rules= array();
            foreach ($service->rules() as $input => $rule){
                if (array_key_exists($input,$req->all())){
                    $dynamic_rules[$input] = $rule;
                }
            }
            $req->validate($dynamic_rules);
        }else{
        $req->validate($service->rules());
        }

        $return = $service->update($req->all());
        return response()->json($return,206);
    }



}
