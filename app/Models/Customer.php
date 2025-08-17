<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone_number',
        'payout_amount',
        'payout_date',
        'place_of_residence',
        'customer_id',
        'password',
        'available_balance',
        'pending_balance',
        'currency',
    ];

    protected $casts = [
        'payout_date' => 'date',
        'payout_amount' => 'decimal:2',
    ];
}
