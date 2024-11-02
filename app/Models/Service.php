<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use App\Models\Customer;
class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "id",'customer_id','employee1_id',
        'employee2_id','service_date',
        'period','frequency','notes','instructions',
        'paid_out','fee','finance_notes','payment','frequency_payment',
        'who_saved','who_saved_id',
        'price','justify_minus', 'minus',
        'justify_plus','plus', 'confirmed',
        'deleted_at'
    ];
    public $rules =  [
        'customer_id' => 'required|numeric',
        'employee1_id' => 'required|numeric',
        'employee2_id' => 'nullable',
        'service_date' => 'required|date',
        'period' => 'alpha_num:ascii',
        'frequency' => 'required',
        'notes' => 'nullable',
        'instructions' => 'nullable',
        'paid_out' => 'nullable',
        'fee' => 'nullable',
        'finance_notes' => 'nullable',
        'payment' => 'nullable',
        'who_saved' => 'string',
        'who_saved_id' => 'nullable',
        'price' => 'numeric',
        'justify_plus' => 'present_with:plus',
        'plus' => 'nullable',
        'justify_minus' => 'present_with:minus',
        'minus' => 'nullable',
        'checkin_datetime' => 'date',
        'checkout_datetime' => 'date',
        'phone' => 'nullable',
        'address' => 'nullable'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee1_id');
    }
    public function employee2()
    {
        return $this->belongsTo(Employee::class,'employee2_id');
    }
    public function control()
    {
        return $this->hasOne(ServiceControl::class,'service_id');
    }
    public function payment(){
        return $this->belongsTo(Payment::class,'payment');
    }
    public function rules(): array
    {
        return $this->rules;
    }
}
