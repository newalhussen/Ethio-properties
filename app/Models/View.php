<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ['car_id','user_id','type','ip_address'];

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function viewer() {
        return $this->belongsTo(User::class,'user_id');
    }
}
