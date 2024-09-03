<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use stdClass;

#[AllowDynamicProperties] class EmployeeController extends Controller
{
    private Employee $employee ;

    public function __construct(Employee $employee,public string|null $msg = null)
    {
        $this->employee = $employee;
        $this->configpage = 50;
        $this->st = new StdClass();
        $this->st->status = true;

    }
    public function employee_filter($type, $orderBy = 'name'){
        return $this->employee->where('type','=',strtoupper($type))->orderBy($orderBy)->paginate($this->configpage);
    }
    public function index(string  $filter = 'RESIDENTIAL',$msg = null){
        if(!isset($this->configpage))$this->configpage = 50;
        switch (strtoupper($filter)){
            case'COMMERCIAL':
                $filtered =  $this->employee_filter('COMMERCIAL');
                $filtered_type = 'COMMERCIAL';
                break;
            default:
                $filtered =  $this->employee_filter('RESIDENTIAL');;
                $filtered_type = 'RESIDENTIAL';
            break;
        }


        return view('employees',[
            'employees' => $filtered,
                'msg' =>$msg,
                "type" => $filtered_type
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
        return redirect()->back()->with(['success'=>$this->st,"type" => $request->filtered_type,"msg" => $msg]);


    }
    public function update(Request $request,$id,string|null $msg=null){
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

        if( $employee->update($request->all())){
            $this->st->msg = 'The employee <b>'.$employee->getAttribute('name').'</b> is updated!';
            return redirect()->back()->with('success',$this->st);
        }else{
        $this->st->status = false;
        $this->st->msg = 'The employee <b>'.$employee->getAttribute('name').'</b> is not updated!';
        return redirect()->back()->with(['errors',$this->st,"msg" => $msg]);
        }

    }

    public function destroy ($employee){

    }
}
