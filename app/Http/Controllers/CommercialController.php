<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Treatment\DateTreatment;

class CommercialController extends Controller
{

    public DateTreatment $date;
    public Employee $employee;
    public Customer $customer;
    public function __construct()
    {
        $this->date = new DateTreatment();
        $this->employee = new Employee();
        $this->customer = new Customer();
    }

    //
    public function index(Request $request, $msg = null)
    {
        /**
         * Tratando dados recebidos no request
         * @param day

         */
        if(!isset($request->day) || $request->day =="current" ){$day = now()->format('m/d/Y');}else{$day = $request->day;}
        $previous = Carbon::create($day)->add(-1,'day')->format('m/d/Y');
        $next = Carbon::create($day)->add(1,'day')->format('m/d/Y');
       return view('commercial.schedule',
           [
               'day' => $day,
               'previous' => $previous,
               'next'=> $next ,
               'employeesCol' => $this->employee->all()->sortBy('name'),
               'customersCol' => $this->customer->all()->sortBy('name'),
                'msg' => null
           ]
       );
    }
}
