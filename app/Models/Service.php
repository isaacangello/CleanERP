<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'employee1_id','employee2_id',
        'customer_id', 'service_date',
        'id','who_saved','fee','period',
        'pgmt','frequency','price','minus',
        'plus','notes','finotes'
    ];
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function employee2(){
        return $this->belongsTo(Service::class,'employee2_id');
    }
}
