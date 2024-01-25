<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use stdClass;

class EmployeeController extends Controller
{
    private Employee $employee ;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
        $this->configpage = 50;
    }

    public function index(){
        if(!isset($this->configpage))$this->configpage = 50;

        return view('employees',[
            'employees' => DB::table('employees')->orderBy('name')->paginate($this->configpage)
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
//        var_dump($request->all());
//        echo"<br><br><hr>";
        $array_data = $request->all();
        $array_data['birth'] = Carbon::create($array_data['birth'])->format('Y-m-d' );
        $array_data['password'] = Hash::make($array_data['password']);
//        dd($array_data);
        $return = $this->employee->create($array_data);

           $st = new StdClass();
           $st->status = true;
           $st->msg = 'The employee '.$return->name.' is registered!';
        return redirect()->back()->with('success',$st);


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
        return view('employees',
            [
                'employees' => DB::table('employees')->orderBy('name')->paginate($this->configpage),

            ]
        );
    }

    public function destroy ($employee){

    }
}
