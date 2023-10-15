<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    //
    public function index(Request $request){
        if(!isset($configpage))$configpage = 50;

        return view('customers',[
            'customers' => DB::table('customers')->paginate($configpage)
        ]);

    }
}
