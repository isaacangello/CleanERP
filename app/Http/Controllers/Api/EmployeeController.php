<?php

namespace App\Http\Controllers\Api;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class EmployeeController extends Controller
{
    private Employee $employee ;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
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
    public function store(Request $request){
        /**
         *  campos
         name phone email birth address name_ref_one name_ref_two phone_ref_one phone_ref_two
         restriction document description type status shift username password new_user
         */
        $request->validate($this->employee->rules());
        $retorun = $this->employee->create($request->all());
        return response()->json($retorun,200);

    }
    public function update(Request $request,$id){
        $employee = $this->employee->find($id);
        if($employee === null ){
            return response()->json(['msg' => 'Employee for update not found'],404);
        }
        if($request->method() === 'PATCH'){
            $dynamic_rules = array();
            foreach ($employee->rules() as $input => $rule ){
                if(array_key_exists($input, $request->all())){
                 $dynamic_rules[$input] = $rule;
                }
            }
            $request->validate($dynamic_rules);
//            dd($dynamic_rules);
        }else{
            $request->validate($employee->rules());
        }

        $return = $employee->update($request->all());
        return response()->json($return,200);
    }

    public function destroy ($employee){

    }
}
