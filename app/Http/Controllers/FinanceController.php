<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    //
    public function perc(){

    }
    public function data_sevice_from_employee($employee_id,$from,$till){
         return DB::table('services')->where('employee1_id', $employee_id)
             ->where('services.deleted_at','=',null )
             ->where('services.deleted_at','=',null )
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select('services.id',
                'services.employee1_id',
                'services.employee2_id',
                'services.service_date',
                'services.period',
                'services.frequency',
                'services.paid_out',
                'services.fee',
                'services.finotes',
                'services.pgmt',
                'services.who_saved',
                'services.price',
                'services.plus',
                'services.minus',
                'employees.name as employee',
                'customers.name as customer',
                'customers.price_weekly'
            )->get();
    }
    public function index (Request $request){
        $colllecion_services =$this->data_sevice_from_employee(3);
        dd($colllecion_services);
        return view('finances',
        [ 'employees' => Employee::all()]
        );
    }
}
