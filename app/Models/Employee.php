<?php

namespace App\Models;

use Carbon\Carbon;
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
            'nome','phone','email','address',
            'namerefone','namereftwo','phonerefone',
            'phonereftwo','description', 'type',
            'status','shift','username',
            'password','newuser'
        ];
    public function rules(){
        return[
            'name' => 'require:unique:employees,name',
            'phone' =>'require',
            'email' => 'require',
            'birth' => 'require',
            'address' =>'require',
            'namerefone' =>"nullable",
            'namereftwo' =>'nullable',
            'phonerefone' =>'nullable',
            'phonereftwo' =>'nullable',
            'restriction' =>'nullable',
            'description' =>'nullable',
            'document' =>'nullable',
            'type' =>'require',
            'status' =>'require',
            'shift' =>'nullable',
            'username' =>'require:unique:employees,username',
            'password' =>'nullable',
            'newuser' =>'nullable',
        ];
    }
    public function feedback(){
        return[

        ];
    }
    public function services():hasMany
    {
        return $this->hasMany(Service::class,'employee1_id');
    }

    public function servicesFromDate($date,$numberRegsPage = 15){
//        echo "$date <br>";
        $carbon_date = Carbon::create($date);
      $result_emp1 =  DB::table('services')
            ->whereBetween('service_date',[$carbon_date->format('Y-m-d 00:00:00'),$carbon_date->format('Y-m-d 11:59:56')] )
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
    public function servicesFromPeriodWhithEmpId($from,$till,$empId = null,$numberRegsPage = 15){
     if($empId == null){
        return [];
     }else{
        $carbon_from = Carbon::create($from);
        $carbon_till = Carbon::create($till);

      $result_services =  DB::table('services')
            ->where('employee1_id','=', $empId )
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
                'customers.type as cust_type',
                'employees.name as emp_name'
            )->get()->sortBy('emp_name')->groupBy('emp_name');

        return $result_services;
      }
    }

}
