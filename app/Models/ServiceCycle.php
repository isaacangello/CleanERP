<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCycle extends Model
{
    use HasFactory;
    protected $table = 'services_cycles';
    protected $guarded = [];
}
