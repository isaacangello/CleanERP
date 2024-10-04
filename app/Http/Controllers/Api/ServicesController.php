<?php

namespace App\Http\Controllers\Api;

//use App\View\Components\customer;
use App\Helpers\Funcs;
use App\Http\Controllers\Populate;
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

    /**
     * @param Request $request
     * @param $msg
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
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

            $numweek = $this->date->numberWeekByDay(now()->format('Y-m-d'));
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
                $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeekNumber($row->id,$this->date->numberWeekByDay(now()->format('Y-m-d')));;
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
            'cardsHtml' => $html,
        ]);
    }

    /**
     * @param Request $req
     * @return void
     */
    public function index(Request $req){
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id){
        $service = $this->service->with('customer','employee', 'employee2','control')->find($id) ;
        $status = 200;
        return response()->json($service,$status);
    }

    /**
     * @param Request $request
     * @param $id
     * @param $fields
     * @return \Illuminate\Http\JsonResponse
     */
    public function query(Request $request,$id, $fields){
        $firstParam = explode(':', $fields)[0];
        $queryString = explode(':', $fields)[1];
        if($firstParam === "with"){
            if($fields){
                $service = $this->service->selectRaw($queryString)->with('customer','employee', 'employee2','control')->find($id);
                $status = 206;
            }
        }else{
            $service = $this->service->selectRaw($queryString)->find($id);
            $status = 206;
        }
        return response()->json($service,$status);
    }

    /**
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $req): \Illuminate\Http\JsonResponse
    {
        if($req->all() === null){
            return response()->json(['msg' => 'need data to store.'],404);
        }
        //return response()->json(['msg' => $req->all()],200);
        $req->validate($this->service->rules());
        $service_date = Funcs::dateTimeToDB($req->service_date,$req->service_time); //Carbon::create($req->service_date." ".$req->service_time)->format('Y-m-d H:i:s');
        if($req->employee2_id === "0"){$employee2_id = $req->employee1_id;}else{$employee2_id = $req->employee2_id;}
        $frequency_payment = explode(',',$req->frequency_payment);
        $return = $this->service->create([
                'customer_id' => $req->customer_id,
                'employee1_id' =>$req->employee1_id,
                'employee2_id'=>$employee2_id,
                'service_date'=>$service_date,
                'period'=>$req->period,
                'frequency'=>$req->frequency,
                'notes' => $req->notes,
                'instructions' => $req->instructions,
                'frequency_payment'=>$frequency_payment[0],
                'payment'=>$req->payment,
                'who_saved'=>$req->who_saved,
                'price'=>$frequency_payment[1],
                'who_saved_id'=>$req->who_saved_id,
            ]
        );
        $employees =  Populate::employeeFilter('residential','name');

        foreach ($employees as $row){
            $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeekNumber($row->id,$req->numWeek);;

        }
        /** Rendering HTML elements in server side SSR */
        $html = Funcs::createResidentialCard($filteredWeekGroup,$req->numWeek);

        return response()->json(['message' => "Service has been scheduled on date $req->service_date, $req->service_time", 'html' => $html],201);
    }

    /**
     * @param $id
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $req){
        //dd($req);
        $dynamic_rules = array();
        foreach ($this->service->rules() as $input => $rule ){
            if(array_key_exists($input, $req->all())){
                $dynamic_rules[$input] = $rule;
            }
        }
        $req->validate($dynamic_rules);
        $result =  $this->service->find($id);
        $valOld = "next";
//        return response()->json(['retorno' => Carbon::create($req->value)->format('Y-m-d')]);
        switch ($req->fieldName){
            case'birth': $val_update = Carbon::create($req->value)->format('Y-m-d');
            default: $val_update = $req->value;
        }
        $result->update([
            $req->fieldName => $val_update
        ]);
        $result->save();
        return response()->json(['_token' => $req->_token,'fieldName' =>$req->fieldName,'value' => $val_update, $req->fieldName => $valOld ]);
    }

    /**
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $req)
    {

        $service = $this->service->find($req->id);
//        dd();
        if ($service->confirmed === 0) {
            $service->update(['confirmed' => 1]);
            $msg = "Service has been confirmed";
        } else {
            $service->update(['confirmed' => 0]);
            $msg = "Service has been decommitted";
        }
        $employees =  Populate::employeeFilter('residential','name');

        foreach ($employees as $row){
            $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeekNumber($row->id,$req->numWeek,$req->year);;

        }
        /** Rendering HTML elements in server side SSR */
        $html = Funcs::createResidentialCard($filteredWeekGroup,$req->numWeek,$req->year);

            return response()->json(['message' =>  $msg, 'html' => $html ],200);
    }

    public function fee(Request $req)
    {
        $service = $this->service->find($req->id);
        if ($service->fee <= 0) {
            $service->update([
                'fee' => 1,
                'fee_notes' => $req->fee_notes
            ]);

            $msg = "Service is canceled";
        } else {
            $service->update([
            'fee' => 0,
            'fee_notes' => $req->fee_notes
            ]);
            $msg = "Service is not canceled";
        }
        $employees =  Populate::employeeFilter('residential','name');

        foreach ($employees as $row){
            $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeekNumber($row->id,$req->numWeek,$req->year);;

        }
        /** Rendering HTML elements in server side SSR */
        $html = Funcs::createResidentialCard($filteredWeekGroup,$req->numWeek,$req->year);
        return response()->json(['message' => $msg, 'html' => $html ],206);
    }


    /**
     * @param $id
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id,Request $req)
    {
        $schedule = $this->service->find($id);
        $schedule->delete();

        $employees =  Populate::employeeFilter('residential','name');
        if(is_numeric($req->numWeek) && $req->numWeek > 0){
            $weekNun = $req->numWeek;
        }else{
            $weekNun = $this->date->numberWeekByDay(now()->format('Y-m-d'));
        }

        foreach ($employees as $row){
            $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeekNumber($row->id,$weekNun);;

        }
        /** Rendering HTML elements in server side SSR */
        $html = Funcs::createResidentialCard($filteredWeekGroup,$weekNun);

        return response()->json(['message' =>  'Service has been deleted!', 'html' => $html ],200);

    }

    /**
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $req)
    {
        if(empty($req->id)){
            return response()->json(['message'=>'service id not found.'],422);
        }
        $schedule = $this->service->find($req->id);
        $schedule->delete();

        $employees =  Populate::employeeFilter('residential','name');
        if(is_numeric($req->numWeek) && $req->numWeek > 0){
            $weekNun = $req->numWeek;
        }else{
            $weekNun = $this->date->numberWeekByDay(now()->format('Y-m-d'));
        }
        if(is_numeric($req->year) && $req->year > 0){
            $year = $req->year;
        }else{
            $year = now()->format('Y');
        }

        foreach ($employees as $row){
            $filteredWeekGroup[$row->name] = $this->employee->servicesFromWeekNumber($row->id,$weekNun,$year);;
        }
        /** Rendering HTML elements in server side SSR */
        $html = Funcs::createResidentialCard($filteredWeekGroup,$weekNun,$year);

        return response()->json(['message' =>  'Service has been deleted!', 'html' => $html ],200);

    }



}
