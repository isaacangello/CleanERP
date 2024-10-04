<?php
namespace App\Helpers\Finance;
use App\Http\Controllers\FinanceController;
use App\Models\Config;
use App\Models\Employee;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait FinanceTrait
{
    public function totalServicesPricesEmployees(int $employeeId,string $from,string $till): null|array{
        $array_result = array();
        $collection_result =  DB::table('services')->where('employee1_id', $employeeId)
            ->whereDate('service_date','>=',$from )
            ->whereDate('service_date','<=',$till )
            ->whereNull('services.deleted_at')
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'services.employee1_id',
                        'services.price',
                        'services.plus',
                        'services.minus',
            )->get();
            $array_result = [
                    'employee_id' => $employeeId,
                    'total_services_price' => $collection_result->sum('price'),
                    'total_plus' => $collection_result->sum('plus'),
                    'total_minus' => $collection_result->sum('minus'),
                ];
        return $array_result;
    }
    public function servicesEmployee (int $employeeId,string $from,string $till): \Illuminate\Support\Collection
    {
        //$array_result = array();
        return DB::table('services')->where('employee1_id', $employeeId)
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
    public function getData($numWeek = null, $year = null)
    {

        $model = new Employee();
        $finance = new FinanceController();
        $date = new DateTreatment();
        $getConfig = new Config();
        $config = $getConfig->firstOrCreate(
            ['user_id' => \Auth::id()],
            [ 'nun_reg_pages' =>  15 ]
        );
        if($numWeek === null)$numWeek = $date->numberWeekByDay(now()->timezone('America/New_York')->format('Y-m-d'));
        if ($year === null) $year = now()->format('Y');
        $dateFrom = $date->getWeekByNumberWeek($numWeek,$year);
        $all_employees = $model->select()->where('status' , '=', "ACTIVE")
            ->where('type', '=',"RESIDENTIAL" )->orderBy('name')->get()->toArray();

        $collection_employees = $model->select()->where('status' , '=', "ACTIVE")
            ->where('type', '=',"RESIDENTIAL" )->orderBy('name')->paginate($config->nun_reg_pages)->toArray();
        $array_temp = $finance->getEmployeeServices(new DateTreatment(),$dateFrom['Monday'],$config->nun_reg_pages);

        $cem = $finance->total_price_services_period($dateFrom['Monday'],$dateFrom['Saturday']);
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


}