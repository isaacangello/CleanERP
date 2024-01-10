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
    public function rules(): array
    {

        return [
            'name' => 'required',
            'address' => 'required',
            'complement' => 'nullable',
            'phone' => 'numeric',
            'email' => 'email:rfc,dns',
            'type' => 'nullable|string',
            'status' => 'nullable|string',
            'frequency' => 'nullable|string',
            'price_weekly' => 'nullable|numeric',
            'price_biweekly' => 'nullable|numeric',
            'price_monthly' => 'nullable|numeric',
            'other_services' => 'nullable|string',
            'justify_inactive' => 'nullable|string',
            'info' => 'nullable',
            'drive_licence' => 'nullable',
            'key' => 'nullable',
            'more_girl' => 'nullable',
            'gate_code' => 'nullable',
            'house_description' => 'nullable|string',
            'note' => 'nullable|string',
        ];

    }
}
