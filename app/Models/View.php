<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ['car_id','viewer_id','type'];

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function viewer() {
        return $this->belongsTo(User::class,'viewer_id');
    }
}
