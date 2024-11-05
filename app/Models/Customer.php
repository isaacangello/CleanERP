<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id','name','address','complement','phone','email','type','status',
        'frequency','others_emails',
        'other_services','justify_inactive','info',
        'drive_licence','key','more_girl','gate_code',
        'house_description','note','charges_customers',
        'created_at'
    ];
    public function rules(): array
    {

        return [
            'name' => 'required|unique:customers,name,'.$this->id,
            'address' => 'required',
            'complement' => 'nullable',
            'phone' => 'numeric',
            'email' => 'email:rfc,dns',
            'type' => 'nullable|string',
            'status' => 'nullable|string',
            'frequency' => 'nullable|string',
            'other_services' => 'nullable|string',
            'justify_inactive' => 'nullable|string',
            'info' => 'nullable',
            'drive_licence' => 'nullable',
            'key' => 'nullable',
            'more_girl' => 'nullable',
            'gate_code' => 'nullable',
            'house_description' => 'nullable|string',
            'note' => 'nullable|string',
            'standard_billings' => 'nullable',
            'others_emails'=> 'nullable',
        ];

    }
    public function Services()
    {
        $this->hasMany(Service::class);
    }
    public function billings()
    {
        return $this->belongsToMany(Billing::class,'billings_customers','customer_id','billing_id');
    }
    public function schedules_repeat()
    {
        return $this->belongsToMany(Schedule::class,'schedules_customers','customer_id','schedule_id');
    }
    public function services_repeat()
    {
        return $this->belongsToMany(Service::class,'services_customers','customer_id','service_id');
    }
}
