<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{

    public function __construct(Customer $cust)
    {
        $this->configpage = 50;
        $this->cust = $cust;
    }

    public function index(Request $request){


        return view('customers',[
            'customers' => DB::table('customers')->orderBy('name')->paginate($this->configpage)
        ]);

    }

    public function store(Request $request){


        $request->validate($this->cust->rules());
        if($request->drive_licence == null){$drive_licence = false;}else{$drive_licence = $request->drive_licence;}
        if($request->key == null){$key = false;}else{$key = $request->key;}
        if($request->more_girl == null){$more_girl = false;}else{$more_girl = $request->more_girl;}
        if($request->gate_code == null){$gate_code = false;}else{$gate_code = $request->gate_code;}
        $this->cust->create( [
            'name' => $request->name,
            'address' => $request->address,
            'complement' => $request->complement,
            'phone' => $request->phone,
            'email' => $request->email,
            'type' => $request->type,
            'status' => $request->status,
            'frequency' => $request->frequency,
            'price_weekly' => $request->price_weekly,
            'price_biweekly' => $request->price_biweekly,
            'price_monthly' => $request->price_monthly,
            'other_services' => $request->other_services,
            'justify_inactive' => $request->justify_inactive,
            'info' => 'required',
            'drive_licence' => $drive_licence,
            'key' => $key ,
            'more_girl' => $more_girl,
            'gate_code' => $gate_code,
            'house_description' => 'required',
            'note' => 'required',
        ]);


        return view('customers',[
            'customers' => DB::table('customers')->orderBy('name')->paginate($this->configpage),
            'stored' => 'O Customer '.$request->name." Successfully saved!"
        ]);

    }

}
