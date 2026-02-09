<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'houses';
    protected $fillable = [
    'user_id',
    'title_en',
    'title_am',
    'slug',
    'purpose',
    'property_type',
    'price',
    'built_year',
    'bedrooms',
    'bathrooms',
    'area_m2',
    'floors',
    'parking',
    'negotiable',
    'installment',
    'garage',
    'description_en',
    'description_am',
    'region',
    'subcity_en',
    'address',
    'latitude',
    'longitude',
    'amenities',
    'images',
    'seller_type',
    'contact_phone',
    'contact_email',
    'verified',
    'status',
];


protected $casts = [
    'amenities' => 'array',
    'images' => 'array',
    'meta' => 'array',
    'negotiable' => 'boolean',
    'installment' => 'boolean',
    'garage' => 'boolean',
    'verified' => 'boolean',
    'approved_at' => 'datetime',
    'price' => 'float',
];


    // Accessor: get title depending on locale
    public function getTitleAttribute($value)
    {
        $locale = app()->getLocale();
        return $locale === 'am' && $this->title_am ? $this->title_am : $this->title_en;
    }

    // Convenience to get description by locale
    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'am' && $this->description_am ? $this->description_am : $this->description_en;
    }

    // Create slug on creating
    protected static function booted()
    {
        static::creating(function ($house) {
            if (empty($house->slug)) {
                $house->slug = Str::slug($house->title_en) . '-' . Str::random(6);
            }
            if (empty($house->status)) {
                $house->status = 'pending';
            }
        });
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
    public function owner()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

    
    
}
