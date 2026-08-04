<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

protected $fillable = [
    'brand','model','title','title_am','description','description_am',
    'year','transmission','body_type','color','fuel','engine_size',
    'seats','doors','drive_type','condition','mileage',
    'images','video','price',
    'seller_name','seller_type','contact_phone','contact_email','seller_address',
    'sale_rent','price_type','is_featured',
    'user_id','status'
];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'approved_at' => 'datetime',
        'images' => 'array',
    ];

public function user()
{
    return $this->belongsTo(User::class);
}

    public function carImages()
    {
        return $this->hasMany(\App\Models\CarImage::class, 'car_id');
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    // Moderation scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Localization helpers
    public function getBrandLocalizedAttribute()
    {
        $locale = app()->getLocale();
        $brand = $this->brand;

        if (is_string($brand)) {
            $brand = json_decode($brand, true) ?: $brand;
        }

        return is_array($brand) ? ($brand[$locale] ?? $brand['en'] ?? reset($brand)) : $brand;
    }

    public function getModelLocalizedAttribute()
    {
        $locale = app()->getLocale();
        $model = $this->model;

        if (is_string($model)) {
            $model = json_decode($model, true) ?: $model;
        }

        return is_array($model) ? ($model[$locale] ?? $model['en'] ?? reset($model)) : $model;
    }

    public function getFuelLocalizedAttribute()
    {
        $locale = app()->getLocale();
        $fuel = $this->fuel;

        if (is_string($fuel)) {
            $fuel = json_decode($fuel, true) ?: $fuel;
        }

        return is_array($fuel) ? ($fuel[$locale] ?? $fuel['en'] ?? reset($fuel)) : $fuel;
    }

public function owner()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
