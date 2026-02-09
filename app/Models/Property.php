<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',           // 'car' or 'house'
        'transaction',    // 'sell' or 'rent'
        'price',
        'city',
        'address',
        'main_image',
        'title',          // JSON: {"en": "...", "am": "..."}
        'description',    // JSON: {"en": "...", "am": "..."}
        'is_published',
    ];

    // Relation to Car
    public function car()
    {
        return $this->hasOne(Car::class);
    }

    // JSON multilingual helper for title
    public function getTranslatedTitle($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $title = json_decode($this->title, true);
        return $title[$locale] ?? $title['en'] ?? '';
    }

    // JSON multilingual helper for description
    public function getTranslatedDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $desc = json_decode($this->description, true);
        return $desc[$locale] ?? $desc['en'] ?? '';
    }
}
