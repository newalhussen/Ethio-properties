<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallbackRequest extends Model
{
    protected $fillable = ['house_id', 'name', 'phone', 'message'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
