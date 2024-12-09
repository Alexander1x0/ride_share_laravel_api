<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function rides()
    {
        return $this->hasMany(Ride::class);
    }
}

