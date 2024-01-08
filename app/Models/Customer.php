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
    public function rules(){

        return [
            'name' => 'required',
            'address' => 'required',
            'complement' => 'required',
            'phone' => 'numeric',
            'email' => 'email:rfc,dns',
            'type' => 'required',
            'status' => 'string',
            'frequency' => 'string',
            'price_weekly' => 'numeric',
            'price_biweekly' => 'numeric',
            'price_monthly' => 'numeric',
            'other_services' => 'string',
//            'justify_inactive' => 'required',
//            'info' => 'required',
//            'drive_licence' => 'required',
//            'key' => 'required',
//            'more_girl' => 'required',
//            'gate_code' => 'required',
//            'house_description' => 'required',
//            'note' => 'required',
        ];

    }
}
