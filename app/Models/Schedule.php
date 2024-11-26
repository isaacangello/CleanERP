<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id','customer_id','employee_id','period','schedule_time',
        'schedule_date', 'notes', 'instructions','who_saved', 'who_saved_id',
        'loop','denomination','team','team_id'
    ];
    public array $rules = [
        'customer_id' => 'required',
        'employee_id' => 'required',
        'denomination' => 'nullable',
        'schedule_date' => 'required',
        'team' => 'nullable',
        'team_id' => 'nullable',
        'notes' => 'nullable',
        'instructions' => 'nullable',
        'who_saved' => 'nullable',
        'who_saved_id' => 'nullable',
        'checkin_datetime' => 'required',
        'checkout_datetime' => 'required',


    ];
    public function rules()
    {
        return $this->rules;
    }
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function employee( ): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function control()
    {
        return $this->hasOne(ScheduleControl::class,'schedule_id');
    }


}
