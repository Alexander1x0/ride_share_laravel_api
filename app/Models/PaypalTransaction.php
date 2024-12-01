<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_id',
        'user_id',
        'paypal_order_id',
        'status',
        'amount',
        'currency',
        'response',
    ];
}
