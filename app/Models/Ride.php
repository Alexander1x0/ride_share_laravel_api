<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from',
        'to',
        'transport_id',
        'car_id',
        'bike_id',
        'cycle_id',
        'taxi_id',
        'when',
        'date',
        'time',
        'value',
        'payment_way',
        'status',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
