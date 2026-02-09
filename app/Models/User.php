<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',  // keep this if you have a phone column
        'role',   // optional, if you actually use it
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $guard_name = 'web';

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // ✅ Direct relationship to cars (no Seller model)
    public function cars()
    {
        return $this->hasMany(\App\Models\Car::class, 'user_id');
    }

    // ✅ Direct relationship to houses
    public function houses()
    {
        return $this->hasMany(\App\Models\House::class, 'user_id');
    }
    public function ownerSetting()
{
    return $this->hasOne(\App\Models\OwnerSetting::class);
}
}
