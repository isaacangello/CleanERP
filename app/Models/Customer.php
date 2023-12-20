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
        'name','address','complement','phone','email','type','status',
        'frequency','price_weekly','price_biweekly','price_monthly',
        'other_services','regday','info','drivelicence',
        'key','gate_code','house_description'
    ];
}
