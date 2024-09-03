<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Models\Billing;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


#[AllowDynamicProperties] class CustomerController extends Controller
{

    public function __construct(Customer $cust)
    {
        $this->configpage = 50;
        $this->cust = $cust;
    }
    public function filter_customer(string $type = 'residential',string $orderBy = "name"){
        return $this->cust->where('type', '=', strtoupper($type))->orWhere('type', '=', 'RENTALHOUSE')->orderBy($orderBy)->with('billings')->paginate($this->configpage);
    }
    public function index(string $type = 'residential',string $orderBy = "name" ,$msg = null){

        $customers = $this->filter_customer($type);

        return view('customers',
            [
                'customers' => $customers,
                'msg' => $msg,
                'billings_all' => Billing::all(),
                'type' => $type

            ]
        );
    }

    public function store(Request $request, $msg = null){

//        dd($request->all());

        $request->validate($this->cust->rules());
        if(isset($request->drive_licence) and $request->drive_licence == "on"){$drive_licence = 1;}else{$drive_licence = 0;}
        if(isset($request->key) and $request->key == "on"){$key = 1;}else{$key = 0;}
        if(isset($request->more_girl) and $request->more_girl =="on" ){$more_girl = 1;}else{$more_girl = 0;}
        if(isset($request->gate_code) and $request->gate_code == "on"){$gate_code = 1;}else{$gate_code = 0;}

        $return = $this->cust->create( [
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
            'house_description' => $request->house_description,
            'note' => $request->note,
        ]);
        return view('customers',[
            'customers' => $this->filter_customer($request->type),
            'success' => 'O Customer '.$request->name." Successfully saved!",
            'msg' => $msg
        ]);
//        return response()->json($return,201);
    }




}
