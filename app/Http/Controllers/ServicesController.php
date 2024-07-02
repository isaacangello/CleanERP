<?php

namespace App\Http\Controllers;

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
use stdClass;
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
       $this->st = new StdClass();
       $this->st->status = true;

    }

    public function week(Request $request, $msg = null){
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


        return view('week',
            [
               'dataArr' => $filteredWeekGroup,
                'weekArr' => $weekarr,
                'numWeek' => $numweek,
                'year' => $year,
                'employeesCol' => $this->employee->all()->sortBy('name'),
                'customersCol' => $this->customer->all()->sortBy('name'),
                'msg' => $msg,
            ]
        );
    }
    public function index(){

    }
    public function show(Request $request, $id){
        $service = $this->service->find($id);
        return response()->json($service,200);
    }

    public function store(Request $req){
        if($req->all() === null){
//            return response()->json(['msg' => ],404);
            $this->st->status = false;
            $this->st->msg = 'Need data to store service.';
            return redirect()->back()->with('errors',$this->st);

        }

        $req->validate($this->service->rules());

         // selecionando preço do serviço
        $cust_data = null;
         $cust_data = $this->customer->find($req->customer_id);
        $data_save = $req->all();
        if(!is_null($cust_data)){
            if(!is_null($req->frequency_payment)) {
                switch ($req->frequency_payment) {
                    case'Thr':
                    case'One':
                    case'Wek':
                        $frequency_payment = 'price_weekly';
                        $price = $cust_data->price_weekly;
                        break;
                    case'Biw':
                        $frequency_payment = 'price_biweekly';
                        $price = $cust_data->price_biweekly;
                        break;
                    case'Mon':
                        $frequency_payment = 'price_monthly';
                        $price = $cust_data->price_monthly;
                        break;
                }
            }

        }
        if($price > 0){$data_save['price'] = $price; $data_save['frequency_payment'] = $frequency_payment; }
        $data_save['service_date'] = Carbon::create($req->service_date." ".$req->service_time)->format('Y-m-d H:i:s');
        $return = $this->service->create($data_save);
        $this->st->status = true;
        $this->st->msg = 'The service is saved.';
        return redirect()->back()->with('success',$this->st);
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
    public function confirm(Request $req,$id)
    {

        $service = $this->service->find($id);
//        dd();
        if ($service->confirmed === 0) {
            $service->update(['confirmed' => 1]);
            $msg = "Service has been confirmed";
        } else {
            $service->update(['confirmed' => 0]);
            $msg = "Service has been decommitted";
        }
        return redirect()->back()->with(['msg' => $msg]);
    }
}
