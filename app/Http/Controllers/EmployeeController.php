<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request){
        if(!isset($configpage))$configpage = 50;

        return view('employees',[
            'employees' => DB::table('employees')->paginate($configpage)
            ]
        );
    }
}
