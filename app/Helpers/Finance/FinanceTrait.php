<?php
namespace App\Helpers\Finance;
use App\Treatment\DateTreatment;
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
                'services.who_saved',
                'services.price',
                'services.plus',
                'services.minus',
                'employees.name as emp_name',
                'customers.name as cust_name',
                'customers.address'
            )->get();
    }

}