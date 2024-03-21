<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    public function __construct(Customer $cust)
    {
        $this->configpage = 50;
        $this->cust = $cust;
    }

    public function index(Request $request){
        return view('customers',['customers' => DB::table('customers')->orderBy('name')->paginate($this->configpage)]);
    }

    public function store(Request $request){

//        dd($request->all());

        $request->validate($this->cust->rules());
        if(isset($request->drive_licence) and $request->drive_licence == "on"){$drive_licence = 1;}else{$drive_licence = 0;}
        if(isset($request->key) and $request->key == "on"){$key = 1;}else{$key = 0;}
        if(isset($request->more_girl) and $request->more_girl =="on" ){$more_girl = 1;}else{$more_girl = 0;}
        if(isset($request->gate_code) and $request->gate_code == "on"){$gate_code = 1;}else{$gate_code = 0;}
//            echo"<br>drive_licence > ";var_dump($drive_licence);
//            echo"<br>key > ";var_dump($key);
//            echo"<br>more_girl > ";var_dump($more_girl);
//            echo"<br>gate_code > ";var_dump($gate_code);
//            dd($drive_licence);

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
//        return view('customers',[
//            'customers' => DB::table('customers')->orderBy('name')->paginate($this->configpage),
//            'stored' => 'O Customer '.$request->name." Susccessfully saved!"
//        ]);
        return response()->json($return,201);
    }
    public function update($id, Request $req)
    {
        //dd($req);
            $dynamic_rules = array();
            foreach ($this->cust->rules() as $input => $rule ){
                if(array_key_exists($input, $req->all())){
                 $dynamic_rules[$input] = $rule;
                }
            }
            $req->validate($dynamic_rules);
            $result =  $this->cust->find($id);
            $valOld = "next";
            switch ($req->fieldName){
                case'drive_licence': $valOld = $result->drive_licence;
                case'key': $valOld = $result->key;
                case'more_girl': $valOld = $result->more_girl;
                case'gate_code': $valOld = $result->gate_code;
                default: $val_update = $req->value;
            }
            if($valOld != "next"){
            if($valOld== 0){$val_update = 1;}else{$val_update = 0;}
            }
            $result->update([
                "$req->fieldName" => $val_update
            ]);
            $result->save();
        return response()->json(['_token' => $req->_token,'fieldName' =>$req->fieldName,'value' => $val_update, 'drive_licence' => $result->drive_licence ]);
    }


}
