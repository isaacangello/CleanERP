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

trait FinanceTrait
{
    public function totalServicesPricesEmployee(int $employeeId,string $from,string $till,$orderBy=['employees.name','asc'] ,$type = "RESIDENTIAL"): null|array{
        $array_result = array();
        $collection_result =  DB::table('services')
            ->where('employee1_id', $employeeId)
            ->where('employees.status' , '=', "ACTIVE")
            ->where('employees.type', '=', $type)->orderBy($orderBy[0],$orderBy[1])
            ->whereDate('service_date','>=',$from )
            ->whereDate('service_date','<=',$till )
            ->whereNull('services.deleted_at')
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'services.employee1_id',
                        'employees.name as emp_name',
                        'customers.name as cust_name',
                        'services.price',
                        'services.plus',
                        'services.minus',
            )->get();
          $total_services_price = $collection_result->sum('price');
          $total_plus = $collection_result->sum('plus');
          $total_minus = $collection_result->sum('minus');
          $cem = $total_services_price + $total_plus - $total_minus;
        return [
                'employee_id' => $employeeId,
                'emp_name' => Employee::select('name')->where('id','=',$employeeId)->first()->name,
                'from' => $from,
                'till' => $till,
                'total_services_price' => $cem,
                'total_plus' => $collection_result->sum('plus'),
                'total_minus' => $collection_result->sum('minus'),
                'cem' => $cem,
                'setenta' =>  ($cem*0.7),
                'trinta'=>($cem*0.3)
            ];
    }
    public function totalServicesPriceByPeriod($from,$till,$orderBy=['employees.name','asc'] ,$type = "RESIDENTIAL"): array
    {
        $arr = array();
        $config = Funcs::getConfig();
        $emps = Employee::where('type','=', $type)->orderBy($orderBy[0],$orderBy[1])->paginate($config->nun_reg_pages);
        foreach ($emps as $emp){
            $arr[$emp->id] = $this->totalServicesPricesEmployee($emp->id,$from,$till,$orderBy,$type);
        }
        //dd($arr);
        Return $arr;

    }
    public function servicesEmployee (int $employeeId,string $from,string $till,$orderBy=['employees.name','asc'] ,$type = "RESIDENTIAL"): \Illuminate\Support\Collection
    {
//        var_dump($orderBy);
//        dd($employeeId,$from,$till);
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
                'services.service_date',
                'services.paid_out',
                'services.fee',
                'services.fee_notes',
                'services.payment',
                'services.frequency',
                'services.who_saved',
                'services.price',
                'services.plus',
                'services.minus',
                'employees.name as emp_name',
                'customers.name as cust_name',
                'customers.address'
            )->get();
    }
    public function getData($numWeek,$year): array
    {

        $model = new Employee();
        $finance = new FinanceController();
        $date = new DateTreatment();
        $getConfig = new Config();
        $config = $getConfig->firstOrCreate(
            ['user_id' => \Auth::id()],
            [ 'nun_reg_pages' =>  15 ]
        );
        $dateFrom = $date->getWeekByNumberWeek($numWeek,$year);
        $all_employees = $model->select()->where('status' , '=', "ACTIVE")
            ->where('type', '=',"RESIDENTIAL" )->orderBy('name')->get();

        $collection_employees = $model->select()->where('status' , '=', "ACTIVE")
            ->where('type', '=',"RESIDENTIAL" )->orderBy('name')->paginate($config->nun_reg_pages);


        $array_temp = $this->totalServicesPriceByPeriod($dateFrom['Monday'],$dateFrom['Saturday']);
        if(!isset($cem))$cem=0;
        $total_services = [
            'cem' => $cem,
            'setenta' => ($cem*0.7),
            'trinta' => ($cem*0.3)
        ];

        return[
            'allEmployees' => $all_employees,
            'employees' => $collection_employees,
            'employees_services' => $array_temp,
            'total_services' => $total_services,
        ];
    }
    public function getEmployees ($type="RESIDENTIAL", $status="ACTIVE"): Collection
    {
        $model = new Employee();
        return  $model->select()->where('status' , '=', $status)
            ->where('type', '=', $type)->orderBy('name')->get();

    }

}