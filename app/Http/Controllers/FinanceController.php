<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Treatment\DateTreatment;
use App\Models\Config;

class FinanceController extends Controller
{
    //
    private int $nunregpage;

    public function __construct()
    {
        $config = new Config();
        $this->nunregpage = 15;

    }
    public function total_price_services_period(string $from, string $till): float
    {
        $collection_result =  DB::table('services')
             ->whereDate('service_date','>=',$from)
             ->whereDate('service_date','<=',$till)
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
        'services.price',
                'services.plus',
                'services.minus',
            )->get();
//        $collection_result1 =  DB::table('services')
//             ->whereBetween('service_date',[$from,$till] )
//            ->join('employees', 'services.employee2_id','=','employees.id')
//            ->join('customers','services.customer_id','=', 'customers.id')
//            ->select(
//                'services.price',
//                'services.plus',
//                'services.minus',
//            )->get();

        return ($collection_result->sum('services.price')+$collection_result->sum('services.plus')-$collection_result->sum('services.minus'));
    }
    public function count_payment_employees(int $employee_id,string $from,string $till)
    {
        $array_result = array();
        $collection_result =  DB::table('services')->where('employee1_id', $employee_id)
            ->whereDate('service_date','>=',$from)
            ->whereDate('service_date','<=',$till)
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
        'services.price as price',
                'services.plus as plus',
                'services.minus as minus',
                'employees.name as emp_name',
            )->get();
//        $collection_result1 =  DB::table('services')->where('employee2_id', $employee_id)
//            ->whereBetween('service_date',[$from,$till] )
//            ->join('employees', 'services.employee2_id','=','employees.id')
//            ->join('customers','services.customer_id','=', 'customers.id')
//            ->select(
//            'services.service_date',
//            'services.paid_out',
//            'services.fee',
//            'services.finance_notes',
//            'services.payment',
//            'services.who_saved',
//            'services.price',
//            'services.plus',
//            'services.minus',
//            'employees.name as emp_name',
//            'customers.name as cust_name',
//            'customers.address'
//            )->get();


            $array_from_db = $collection_result->toArray();


//            if($total_price > 0){
//                dd($total_price);
//            }
            foreach ($array_from_db as $row){
//                var_dump($row->emp_name);
//                var_dump($row->price);
                $total += $row->price + $row->plus - $row->minus;
            }
            $array_result['emp_name'] = $row->emp_name;
            $array_result['cem'] = number_format($total,2,'.',',');
            $array_result['setenta'] = number_format(($total*0.7),2,'.',',');
            $array_result['trinta'] = number_format(($total*0.3),2,'.',',');
                //dd('depois do forresh');
//            foreach ($array2_fromdb as $row){
//                $array_result['emp_name'] = $row->emp_name;
//                $array_result['cem'] = number_format($total1,2,'.',',');
//                $array_result['setenta'] = number_format(($total*0.7),2,'.',',');
//                $array_result['trinta'] = number_format(($total*0.3),2,'.',',');
//            }

        return $array_result;
    }
    /**
     * https://laravel.com/docs/10.x/collections#method-flatten
     * esse metodo junta ps array de duas ou mais dimençoe em um
     */
    public function getEmployeeServices(DateTreatment $date, $day = null, $nunRegPage=15){
        $collection_employees = DB::table('employees')
            ->where('employees.type','=','RESIDENTIAL')
            ->orderBy('name', 'asc')->paginate($nunRegPage);
        $i = 0;
        if($day === null){
            $day = Carbon::now()->format('Y-m-d');
        }
        $dateFrom = $date->GetMondaySartuday($day);
//        dd($collection_employees->items());
        $array_temp =array();
        $sorted = $collection_employees;
        foreach ($collection_employees->items() as $employees){
            $data_temp = $this->count_payment_employees($employees->id,$dateFrom['monday'],$dateFrom['saturday']);
            if (empty($data_temp) ){
                $array_temp[$i]= [
                    'emp_name' => $employees->name,
                    'cem' => 0,
                    'setenta' => 0,
                    'trinta' => 0
                ];
            }else{
                $array_temp[$i]=$data_temp;
            }

            $i++;
            //var_dump($data_temp);
        }

        //dd("aqui");
        return $array_temp;
    }
    public function index (Request $request, DateTreatment $date, $day = null){
        /**
         * Alimentando chart
         */
        $cem = $this->total_price_services_period($datefrom['monday'],$datefrom['saturday']);
//        dd($cem);
        $total_services = [
          'cem' => $cem,
          'setenta' => ($cem*0.7),
          'trinta' => ($cem*0.3)
        ];
        $array_temp = $this->getEmployeeServices(new DateTreatment(),$this->nunregpage);

        return view('finance.finances',
        [
            'employees' => $collection_employees,
            'employees_services' => $array_temp,
            'total_services' => $total_services
        ]
        );
    }
    public function detail_employee(){

    }
}
