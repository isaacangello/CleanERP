<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use stdClass;

class EmployeeController extends Controller
{
    private Employee $employee ;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
        $this->st = new StdClass();
    }

    public function index(){
        if(!isset($configpage))$configpage = 50;

        return view('employees',[
            'employees' => DB::table('employees')->orderBy('name')->paginate($configpage)
            ]
        );
    }
    public function show( $employee){
        $response = $this->employee->find($employee);
        if($response === null ){
            return response()->json(['msg' => 'No employee found.'],404) ;
        }
        return $response;

    }
    public function store(Request $request,string|null $msg=null){
        /**
         *  campos
        name phone email birth address name_ref_one name_ref_two phone_ref_one phone_ref_two
        restriction document description type status shift username password new_user
         */

        $request->validate($this->employee->rules());
//        var_dump($request->all());
//        echo"<br><br><hr>";
        $array_data = $request->all();
        $array_data['birth'] = Carbon::create($array_data['birth'])->format('Y-m-d' );
        $array_data['password'] = Hash::make($array_data['password']);
//        dd($array_data);
        $return = $this->employee->create($array_data);

        $this->st->msg = 'The employee <b>'.$return->name.'</b> is registered!';


    return response()->json($return,201);

    }
    public function update($id, Request $req){
        //dd($req);
        $dynamic_rules = array();
        foreach ($this->employee->rules() as $input => $rule ){
            if(array_key_exists($input, $req->all())){
                $dynamic_rules[$input] = $rule;
            }
        }
        $req->validate($dynamic_rules);
        $result =  $this->employee->find($id);
        $valOld = "next";
//        return response()->json(['retorno' => Carbon::create($req->value)->format('Y-m-d')]);
        switch ($req->fieldName){
            case'birth': $val_update = Carbon::create($req->value)->format('Y-m-d');
            default: $val_update = $req->value;
        }
        $result->update([
            $req->fieldName => $val_update
        ]);
        $result->save();
        return response()->json(['_token' => $req->_token,'fieldName' =>$req->fieldName,'value' => $val_update, $req->fieldName => $valOld ]);
    }

    public function destroy ($employee){

    }
}
