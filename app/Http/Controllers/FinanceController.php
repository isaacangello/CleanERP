<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Treatment\DateTreatment;

class FinanceController extends Controller
{
    //
    private int $nunregpage;

    public function __construct()
    {

        $this->nunregpage = 20;

    }
    public function total_price_services_period(string $from, string $till): float
    {
        $collection_result =  DB::table('services')
             ->whereBetween('service_date',[$from,$till] )
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'customers.price_weekly',
            )->get();
        $collection_result1 =  DB::table('services')
             ->whereBetween('service_date',[$from,$till] )
            ->join('employees', 'services.employee2_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'customers.price_weekly',
            )->get();
        $returnvar =  ($collection_result->sum('price_weekly')+$collection_result1->sum('price_weekly'));
        return $returnvar;
    }
    public function count_payment_employees(int $employee_id,string $from,string $till)
    {
        $array_result = array();
        $collection_result =  DB::table('services')->where('employee1_id', $employee_id)
            ->whereBetween('service_date',[$from,$till] )
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
            'services.service_date',
            'services.paid_out',
            'services.fee',
            'services.feenotes',
            'services.pgmt',
            'services.who_saved',
            'services.price',
            'services.plus',
            'services.minus',
            'employees.name as emp_name',
            'customers.name as cust_name',
            'customers.price_weekly',
            'customers.address'
            )->get();
        $collection_result1 =  DB::table('services')->where('employee2_id', $employee_id)
            ->whereBetween('service_date',[$from,$till] )
            ->join('employees', 'services.employee2_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
            'services.service_date',
            'services.paid_out',
            'services.fee',
            'services.feenotes',
            'services.pgmt',
            'services.who_saved',
            'services.price',
            'services.plus',
            'services.minus',
            'employees.name as emp_name',
            'customers.name as cust_name',
            'customers.price_weekly',
            'customers.address'
            )->get();


            $total = $collection_result->sum('price_weekly');
            $total1 = $collection_result1->sum('price_weekly');
            $array_fromdb = $collection_result->toArray();
            $array2_fromdb = $collection_result1->toArray();

            foreach ($array_fromdb as $row){
                $array_result['emp_name'] = $row->emp_name;
                $array_result['cem'] = number_format($total,2,'.',',');
                $array_result['setenta'] = number_format(($total*0.7),2,'.',',');
                $array_result['trinta'] = number_format(($total*0.3),2,'.',',');
            }
            foreach ($array2_fromdb as $row){
                $array_result['emp_name'] = $row->emp_name;
                $array_result['cem'] = number_format($total1,2,'.',',');
                $array_result['setenta'] = number_format(($total*0.7),2,'.',',');
                $array_result['trinta'] = number_format(($total*0.3),2,'.',',');
            }
        return $array_result;
    }
    /**
     * https://laravel.com/docs/10.x/collections#method-flatten
     * esse metodo junta ps array de duas ou mais dimençoe em um
     */

    public function index (Request $request, DateTreatment $date, $day = null){
        $collection_employees = DB::table('employees')->orderBy('name', 'asc')->paginate($this->nunregpage);
        $i = 0;
        $datefrom = $date->GetMondaySartuday();
//        dd($collection_employees->items());
        $array_temp =array();
        $sorted = $collection_employees;
        foreach ($collection_employees->items() as $employees){
            $data_temp = $this->count_payment_employees($employees->id,$datefrom['monday'],$datefrom['saturday']);

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
        }
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
