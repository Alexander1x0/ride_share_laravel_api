<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['transport_id', 'available', 'name', 'max_power', 'fuel', 'max_speed',
                            'model', 'capacity', 'color', 'fuel type', 'gear_type', 'rate', 'image_path'];
                            
    protected $hidden = ['created_at', 'updated_at'];

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }

    public function rides()
    {
        return $this->hasMany(Ride::class);
    }

}
