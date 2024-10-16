<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;

class PopulateController extends Controller
{
    //
    public Employee $employee;
    public Customer $cust ;
    public function __construct()
    {
        $this->employee = new Employee();
        $this->cust = new Customer();
    }
    public function employee_filter($type = 'RESIDENTIAL', $orderBy = 'name',int $NunOfPages = 0){
        if ($NunOfPages <= 0){
            return $this->employee->where('type','=',strtoupper($type))->orderBy($orderBy)->get();
        }else{
            return $this->employee->where('type','=',strtoupper($type))->orderBy($orderBy)->paginate($NunOfPages);
        }

    }
    public function filter_customer(string $type = 'RESIDENTIAL',string $orderBy = "name",int $NunOfPages = 0){
        if ($NunOfPages <= 0 ){
            if(strtoupper($type)==="COMMERCIAL")return $this->cust->where('type', '=', strtoupper($type))->orderBy($orderBy)->with('billings')->get();
            if(strtoupper($type)==="RESIDENTIAL")return $this->cust->where('type', '=', strtoupper($type))->orWhere('type', '=', 'RENTALHOUSE')->orderBy($orderBy)->with('billings')->get();
        }
        if(strtoupper($type)==="COMMERCIAL") return $this->cust->where('type', '=', strtoupper($type))->orderBy($orderBy)->with('billings')->paginate($NunOfPages);
        if(strtoupper($type)==="RESIDENTIAL" )return $this->cust->where('type', '=', strtoupper($type))->orWhere('type', '=', 'RENTALHOUSE')->orderBy($orderBy)->with('billings')->paginate($NunOfPages);
        return 0;
    }

}
