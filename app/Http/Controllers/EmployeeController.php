<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    private Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function index(){
        if(!isset($configpage))$configpage = 50;

        return view('employees',[
            'employees' => DB::table('employees')->paginate($configpage)
            ]
        );
    }
    public function store(Request $request){


    }

}
