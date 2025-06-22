<?php
namespace App\Helpers\Finance;
use App\Helpers\Funcs;
use App\Http\Controllers\FinanceController;
use App\Models\Config;
use App\Models\Employee;
use App\Treatment\DateTreatment;
use Cassandra\Type;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

trait FinanceTrait
{
    public function totalServicesPricesEmployee(int $employeeId,string $from,string $till,$orderBy=['employees.name','asc'] ,$type = "RESIDENTIAL"): null|array{
        $from = Carbon::create($from)->format('Y-m-d H:i:s');
        $till = Carbon::create($till)->format('Y-m-d H:i:s');

        $collection_result = DB::table('services')
            ->join('employees', 'services.employee1_id', '=', 'employees.id')
            ->join('customers', 'services.customer_id', '=', 'customers.id')
            ->where('services.employee1_id', $employeeId)
            ->where('employees.status', '=', "ACTIVE")
            ->where('employees.type', '=', $type)
            ->whereDate('services.service_date', '>=', $from)
            ->whereDate('services.service_date', '<=', $till)
            ->whereRaw('(services.price + services.plus + services.minus) != 0')
            ->orderBy($orderBy[0], $orderBy[1])
            ->select(
                'services.employee1_id',
                'employees.name as emp_name',
                'customers.name as cust_name',
                'employees.type',
                'services.service_date',
                'services.price',
                'services.plus',
                'services.minus'
            )
            ->get();

        $total_services_price = 0;
        $total_plus = 0;
        $total_minus = 0;

        foreach ($collection_result as $item) {
            $total_services_price += $item->price;
            $total_plus += $item->plus;
            $total_minus += $item->minus;
        }

        $cem = (float)$total_services_price + (float)$total_plus - (float)$total_minus;
        if ($cem <= 0) $cem = 0;

        return [
            'employee_id' => $employeeId,
            'emp_name' => Employee::select('name')->where('id', '=', $employeeId)->first()->name,
            'from' => $from,
            'till' => $till,
            'total_services_price' => $cem,
            'total_plus' => $total_plus,
            'total_minus' => $total_minus,
            'cem' => $cem,
            'setenta' => ($cem * 0.7),
            'trinta' => ($cem * 0.3)
        ];
//        $array_result = array();
//
//        $from = Carbon::create($from)->format('Y-m-d H:i:s');
//        $till = Carbon::create($till)->format('Y-m-d H:i:s');
//        $collection_result =  DB::table('services')
//            ->where('employee1_id', $employeeId)
//            ->where('employees.status' , '=', "ACTIVE")
//            ->where('employees.type', '=', $type)->orderBy($orderBy[0],$orderBy[1])
//            ->whereDate('service_date','>=',$from )
//            ->whereDate('service_date','<=',$till )
//            ->whereNull('services.deleted_at')
//            ->whereNotNull('services.price')
//            ->whereNotNull('services.plus')
//            ->whereNotNull('services.minus')
//            ->join('employees', 'services.employee1_id','=','employees.id')
//            ->join('customers','services.customer_id','=', 'customers.id')
//            ->select(
//                'services.employee1_id',
//                        'employees.name as emp_name',
//                        'customers.name as cust_name',
//                        'employees.type',
//                        'services.service_date',
//                        'services.price',
//                        'services.plus',
//                        'services.minus',
//            )->get();
//        $total_services_price = 0; $total_plus = 0; $total_minus = 0;
//       foreach ($collection_result as $item) {
//           $total_services_price += $item->price;
//           $total_plus += $item->plus;
//           $total_minus += $item->minus;
//       }
//          $cem = (float)$total_services_price + (float)$total_plus + -1 *((float)($total_minus));
//          if($cem <= 0) $cem = 0;
//        return [
//                'employee_id' => $employeeId,
//                'emp_name' => Employee::select('name')->where('id','=',$employeeId)->first()->name,
//                'from' => $from,
//                'till' => $till,
//                'total_services_price' => $cem,
//                'total_plus' => $collection_result->sum('plus'),
//                'total_minus' => $collection_result->sum('minus'),
//                'cem' => $cem,
//                'setenta' =>  ($cem*0.7),
//                'trinta'=>($cem*0.3)
//            ];
    }
    public function totalServicesPriceByPeriod($from,$till,$orderBy=['employees.name','asc'] ,$type = "RESIDENTIAL"): array
    {
        $arr = array();
        $config = Funcs::getConfig();
        $emps = Employee::where('type','=', $type)->orderBy($orderBy[0],$orderBy[1])->paginate($config->nun_reg_pages);
        foreach ($emps as $emp){
            $funcReturn   = $this->totalServicesPricesEmployee($emp->id,$from,$till,$orderBy,$type);
            if($funcReturn['cem'] != 0)$arr[$emp->id] = $funcReturn;
            //$arr[$emp->id] = $this->totalServicesPricesEmployee($emp->id,$from,$till,$orderBy,$type);
        }
        //dd($arr);
        Return $arr;

    }

    public function getServicesById($id): Collection
    {
        return DB::table('services')
            ->where('services.id', $id)
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'services.id',
                'services.service_date',
                'services.paid_out',
                'services.fee',
                'services.finance_notes',
                'services.payment',
                'services.frequency',
                'services.who_saved',
                'services.price',
                'services.plus',
                'services.minus',
                'employees.name as emp_name',
                'customers.name as cust_name',
                'services.customer_id as customer_id',
                'customers.address'
            )->get();

    }
    public function servicesEmployee (int $employeeId,string $from,string $till,$orderBy=['services.service_date','asc'] ,$type = "RESIDENTIAL"): \Illuminate\Support\Collection
    {
        $from = Carbon::create($from)->format('Y-m-d H:i:s');
        $till = Carbon::create($till)->format('Y-m-d H:i:s');
        return DB::table('services')
            ->where('employee1_id', $employeeId)
            ->where('employees.status' , '=', "ACTIVE")
            ->where('employees.type', '=', $type)->orderBy($orderBy[0],$orderBy[1])
            ->whereDate('service_date','>=',$from )
            ->whereDate('service_date','<=',$till )
            ->whereNull('services.deleted_at')
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'services.id as id',
                'services.service_date',
                'services.paid_out',
                'services.fee',
                'services.finance_notes',
                'services.payment',
                'services.frequency',
                'services.who_saved',
                'services.price',
                'services.plus',
                'services.minus',
                'employees.name as emp_name',
                'customers.name as cust_name',
                'services.customer_id as customer_id',
                'customers.address'
            )->get();
    }

    public function getTotalPricesByEmployee(string $from,string $till,$orderBy=['employees.name','asc'] ,$type = "RESIDENTIAL", $nun_reg_pages = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $from = Carbon::create($from)->format('Y-m-d 00:00:00');
        $till = Carbon::create($till)->format('Y-m-d 00:00:00');
//        dd($from,$till);
        $results = DB::table('services')
            ->join('employees', 'services.employee1_id', '=', 'employees.id')
            ->where('employees.status', '=', "ACTIVE")
            ->where('employees.type', '=', $type)
            ->whereDate('services.service_date', '>=', $from)
            ->whereDate('services.service_date', '<=', $till)
            ->select(
                'employees.name',
                        'employees.id',
                DB::raw('SUM(services.price + services.plus - services.minus) as total_price')
            )
            ->groupBy('employees.name','employees.id')
            ->havingRaw('SUM(services.price + services.plus - services.minus) != 0')
            ->orderBy($orderBy[0], $orderBy[1])
            ->paginate((int)$nun_reg_pages); // Ajuste o número de itens por página conforme necessário

        return $results;
    }
    public function getData($numWeek,$year): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $date = new DateTreatment();
        $getConfig = Funcs::getConfig();
        $dateFrom = $date->getWeekByNumberWeek($numWeek,$year);

//        dd($this->getTotalPricesByEmployee($dateFrom['Monday'],$dateFrom['Sunday'],['employees.name','asc'],"RESIDENTIAL",$getConfig->nun_reg_pages));
        return $this->getTotalPricesByEmployee($dateFrom['Monday'],$dateFrom['Sunday'],['employees.name','asc'],"RESIDENTIAL",$getConfig->nun_reg_pages);
    }
    public function getEmployees ($type="RESIDENTIAL", $status="ACTIVE"): Collection
    {
        $model = new Employee();
        if($type === "ALL") return $model->select()->where('status' , '=', $status)->orderBy('name')->get();
        if($type === "RESIDENTIAL" || $type === "RENTALHOUSE")return $model->select()->where('status' , '=', $status)->where('type', '=', $type)->orderBy('name')->get();
        if($type === "COMMERCIAL")return $model->select()->where('status' , '=', $status)->where('type', '=', $type)->orderBy('name')->get();

        return collect();
    }
    public function traitNullVars(): void
    {
        $dateTrait = new DateTreatment();
        if($this->numWeek === null){
            $this->numWeek = $dateTrait->numberWeekByDay(Carbon::now()->subWeek()->format('Y-m-d'));
        }
        if ($this->year === null){
            $this->year = Carbon::now()->subWeek()->format('Y');
        }


        $week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Sunday'])->format('m/d/Y') ;
        $this->selectedWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        //dd($this->selectedWeek);
        $this->selectedYear = now()->format('Y');

    }

}