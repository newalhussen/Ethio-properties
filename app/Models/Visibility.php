<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibility extends Model
{
    use HasFactory;
    protected $fillable = [
        'home_hero',
        'home_featured_services',
        'home_cta',
        'home_about',
        'home_stats',
        'home_services',
        'home_departments',
        'home_doctors',
        'home_gallery',
        'home_testimonials',
        'home_partnerships',
        'font_size',
        'high_contrast'
    ];

}
