<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable  = [  'id','label','value','hint'];
    public function customers()
    {
     return $this->belongsToMany(Customer::class, 'billings_customers');
    }
}
