<?php

namespace App\Http\Controllers\Api;

use App\Models\Billing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer;
//use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function __construct(Customer $cust,Billing $billing)
    {
        $this->configpage = 50;
        $this->cust = $cust;
        $this->billing = $billing;

    }
    public function floridaNow()
    {
        return  Carbon::now()->timezone('America/New_York')->format('Y-m-d H:i:s');
    }

    public function index(Request $request){
        return response()->json(['customers' => DB::table('customers')->orderBy('name')->paginate($this->configpage)],200);
    }

    public function show(int $id){
        /**
         * @type Customer $cust
         */
        $cust = $this->cust->with('billings')->find($id);
        return response()->json($cust->toArray(),200);
    }
    public function store(Request $request){
        /**
         * previously validating common data
         */
        $request->validate($this->cust->rules());

        /**
         *  if adding new billing methods
         * will be treated in this place
         */
        ;
        if(count( $request->billing_labels) > 0 ){

            $ids = [];
            $rules = [
                'label' => 'string|min:3|max:30',
                'value' => 'decimal:0,2',
                'hint' => 'string|max:50'

            ];
            /**
             * Once the existence of new billings is confirmed, they will be validated with an instance of the VALIDATOR class
             */
            foreach ($request->billing_labels as $key => $label) {
                $data =['label' => $label, 'value' => $request->billing_values[$key], 'hint' => "Billing price to ".$label];
                $validate[$key] = Validator::make($data,$rules);
                if(!$validate[$key]->fails()){
                    $ids[] = DB::table('billings')->insertGetId(['label' => $label, 'value' => floatval($request->billing_values[$key]), 'hint' => "Billing price to " . $label]);
                }
            }
            if (empty($ids)){
                return response()->json([ "message"=> "Unable to register an empty billing amount."],422);
            }
        }
    /** Validate billing fields */
        if(count($request->billing_values_selected)<= 0){
            return response()->json([ "message"=> "It is not possible to register a customer with empty billing."],422);
        }


        /**
         * Saving de customer data
         */
        if(isset($request->drive_licence) and $request->drive_licence == "on"){$drive_licence = 1;}else{$drive_licence = 0;}
        if(isset($request->key) and $request->key == "on"){$key = 1;}else{$key = 0;}
        if(isset($request->more_girl) and $request->more_girl =="on" ){$more_girl = 1;}else{$more_girl = 0;}
        if(isset($request->gate_code) and $request->gate_code == "on"){$gate_code = 1;}else{$gate_code = 0;}
        if(!isset($request->others_emails)){$others_emails="&nbsp;";}else{$others_emails=$request->others_emails;}
        $return_cust = $this->cust->create( [
            'name' => $request->name,
            'address' => $request->address,
            'complement' => $request->complement,
            'phone' => $request->phone,
            'email' => $request->email,
            'type' => $request->type,
            'status' => $request->status,
            'frequency' => $request->frequency,
            'other_services' => $request->other_services,
            'justify_inactive' => $request->justify_inactive,
            'info' => 'required',
            'drive_licence' => $drive_licence,
            'key' => $key ,
            'more_girl' => $more_girl,
            'gate_code' => $gate_code,
            'house_description' => $request->house_description,
            'note' => $request->note,
            'others_emails' => $others_emails
        ]);
        /**
         * saving de relational Billing data

            @param Carbon
         */
        $now = Carbon::now()->timezone('America/New_York')->format('Y-m-d H:i:s');
        if(!empty($ids)){
            foreach ($ids as $id){
                DB::table('billings_customers')->insert(['customer_id'=> $return_cust->id,'billing_id'=>$id, 'created_at' => $now, 'updated_at' => $now]);
            }
        }
        $billing_rules = [
            'customer_id'=> 'integer',
            'billing_id'=> 'integer',

        ];



            foreach ($request->billing_values_selected as $id){
                Validator::make(['customer_id'=> $return_cust->id,'billing_id'=>$id], $billing_rules );
                DB::table('billings_customers')->insert(['customer_id'=> $return_cust->id,'billing_id'=>$id, 'created_at' => $now, 'updated_at' => $now], );
            }
        $return_billings= 'passou';
        /**
         *  response it's all right
         * this response follow http response standards
         *  https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Status
         */
        return response()->json(['customer'=>$return_cust,'billings' =>$return_billings ],201);
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
            if($valOld=== 0){$val_update = 1;}else{$val_update = 0;}
            }
            $result->update([
                $req->fieldName => $val_update
            ]);
            $result->save();
        return response()->json(['_token' => $req->_token,'fieldName' =>$req->fieldName,'value' => $val_update, $req->fieldName => $valOld ]);
    }

    public function update_billing($id,Request $req): \Illuminate\Http\JsonResponse
    {
         DB::table('billings_customers')->select('id')->where('customer_id','=',$id)->delete();
        $valuesToInsert = [];
        $i =0;
        foreach ($req->billing_values_selected as $b_id){
            $valuesToInsert[$i]['id'] = '';
            $valuesToInsert[$i]['customer_id'] = $id;
            $valuesToInsert[$i]['billing_id'] =$b_id;
            $valuesToInsert[$i]['updated_at'] = $this->floridaNow();
            $valuesToInsert[$i]['created_at'] =$this->floridaNow();
            $i++;
        }
       $result = DB::table('billings_customers')->insertOrIgnore($valuesToInsert);
        return response()->json(['billing'=> $result],200);
    }


}
