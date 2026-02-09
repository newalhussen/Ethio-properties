<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'path'];

    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class, 'car_id');
    }
}
