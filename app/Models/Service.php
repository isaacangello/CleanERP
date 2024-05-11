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
        'customer_id','employee1_id',
        'employee2_id','service_date',
        'period','frequency','notes','instructions',
        'paid_out','fee','fee_notes','payment','frequency_payment',
        'who_saved','who_saved_id',
        'price','justify_minus', 'minus',
        'justify_plus','plus',
    ];
    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Service','employee1_id');
    }
    public function employee2(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Service','employee2_id');
    }
    public function rules(): array
    {
        return [
            'customer_id' => 'required|numeric',
            'employee1_id' => 'required|numeric',
            'employee2_id' => 'required|numeric',
            'service_date' => 'required|date',
            'period' => 'alpha_num:ascii',
            'frequency' => 'nullable',
            'notes' => 'nullable',
            'instructions' => 'nullable',
            'paid_out' => 'nullable',
            'fee' => 'nullable',
            'fee_notes' => 'present_with:fee',
            'payment' => 'nullable',
            'who_saved' => 'alpha_num:ascii',
            'who_saved_id' => 'nullable',
            'price' => 'numeric',
            'justify_plus' => 'present_with:plus',
            'plus' => 'nullable',
            'justify_minus' => 'present_with:minus',
            'minus' => 'nullable',

        ];
    }
}
