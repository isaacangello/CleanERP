<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceControl extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'scheduling_control_residential';
    protected $guarded= [];

}
