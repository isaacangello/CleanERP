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
    public function index (Request $request){

        return view('finances',
        [ 'employees' => Employee::all()]
        );
    }
}
