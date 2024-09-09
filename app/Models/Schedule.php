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
        'customer_id','employee_id','period','schedule_time',
        'schedule_date', 'notes', 'instructions','who_saved',
        'loop','denomination'
    ];
    public array $rules = [
        'customer_id' => 'required',
        'employee1_id' => 'nullable',
        'schedule_date' => 'required',
        'schedule_time' => 'required',
        'loop' => 'required',
        'notes' => 'nullable',
        'instructions' => 'nullable',
        'who_saved' => 'nullable',
        'denomination' => 'required',
    ];
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
