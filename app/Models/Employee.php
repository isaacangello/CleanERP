<?php

namespace App\Models;

use Carbon\Carbon;
use App\Treatment\DateTreatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
            'id','name','phone','email','birth','address',
            'name_ref_one','name_ref_two','phone_ref_one',
            'phone_ref_two','restriction','description','document', 'type',
            'status','shift','username',
            'password','new_user'
        ];
    public function rules(): array
    {
        return[
            'name' => 'required|unique:employees,name,'.$this->id,
            'phone' =>'required',
            'email' => 'required',
            'birth' => 'required',
            'address' =>'required',
            'name_ref_one' =>"nullable",
            'name_ref_two' =>'nullable',
            'phone_ref_one' =>'nullable',
            'phone_ref_two' =>'nullable',
            'restriction' =>'nullable',
            'description' =>'nullable',
            'document' =>'nullable',
            'type' =>'required',
            'status' =>'required',
            'shift' =>'nullable',
            'username' =>'required| unique:employees,username,'.$this->id,
            'password' =>'nullable',
            'newuser' =>'nullable',
        ];
    }
    public function feedback(){
        return[

        ];
    }
    public function services():BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function servicesFromDate($date,$numberRegsPage = 15){
//        echo "$date <br>";
        $carbon_date = Carbon::create($date);
      $result_emp1 =  DB::table('services')
            ->whereDate('service_date',$carbon_date->format('Y-m-d'))
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'services.id as service_id',
                'customer_id as cust_id',
                'employee1_id as emp_id',
                'service_date',
                'period',
                'who_saved',
                'customers.name as cust_name',
                'employees.name as emp_name'
            )->get()->sortBy('emp_name')->groupBy('emp_name');

      return $result_emp1;
    }
    public function servicesFromPeriod($from,$till,$numberRegsPage = 15){
        $carbon_from = Carbon::create($from);
        $carbon_till = Carbon::create($till);
      $result_services =  DB::table('services')
            ->whereBetween('service_date',[$carbon_from->format('Y-m-d 00:00:00'),$carbon_till->format('Y-m-d 11:59:56')] )
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'services.id as service_id',
                'customer_id as cust_id',
                'employee1_id as emp_id',
                'service_date',
                'period',
                'who_saved',
                'customers.name as cust_name',
                'employees.name as emp_name'
            )->get()->sortBy('emp_name')->groupBy('emp_name');

      return $result_services;
    }
    public function servicesFromWeekNumber($emp_id, $weekNun, $year = 'current') :array{
        $date = new DateTreatment();
       $arr_result = [];
       $weekArr = $date->getWeekByNumberWeek($weekNun,$year);
        foreach ($weekArr as $key =>  $weekday){
            $weekdayCarbon = Carbon::create($weekday);
            $arr_result[$key] = DB::table('services')
                ->where('services.employee1_id','=',$emp_id)
                ->whereDate('service_date',$weekdayCarbon->format('Y-m-d') )
                ->join('employees', 'services.employee1_id','=','employees.id')
                ->join('customers','services.customer_id','=', 'customers.id')
                ->orderBy('service_date')
                ->select(
                    'services.id as service_id',
                    'customer_id as cust_id',
                    'employee1_id as emp_id',
                    'service_date',
                    'period',
                    'who_saved',
                    'confirmed',
                    'customers.name as cust_name',
                    'customers.type as cust_type',
                    'employees.name as emp_name'
                )->get()->toArray();
        }

       return $arr_result;
    }
    public function servicesFromPeriodWhithEmpId($from,$till,$empId = null,$numberRegsPage = 15){
     if($empId == null){
        return [];
     }else{
        $carbon_from = Carbon::create($from);
        $carbon_till = Carbon::create($till);

      $result_services =  DB::table('services')
            ->where('employee1_id','=', $empId )
            ->whereDate('service_date',$carbon_from->format('Y-m-d'), )
            ->join('employees', 'services.employee1_id','=','employees.id')
            ->join('customers','services.customer_id','=', 'customers.id')
            ->select(
                'services.id as service_id',
                'customer_id as cust_id',
                'employee1_id as emp_id',
                'service_date',
                'period',
                'who_saved',
                'customers.name as cust_name',
                'customers.type as cust_type',
                'employees.name as emp_name'
            )->get()->sortBy('emp_name')->groupBy('emp_name');

        return $result_services;
      }
    }

}
