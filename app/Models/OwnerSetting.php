<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerSetting extends Model
{
    protected $fillable = [
        'user_id',
        'notify_email_inquiries',
        'notify_sms_inquiries',
        'notify_property_views',
        'notify_property_favorites',
        'notify_weekly_digest',
        'default_listing_type',
        'list_view',
        'currency_format',
        'measurement_unit',
        'dark_mode',
        'extra',
    ];

    protected $casts = [
        'notify_email_inquiries' => 'boolean',
        'notify_sms_inquiries' => 'boolean',
        'notify_property_views' => 'boolean',
        'notify_property_favorites' => 'boolean',
        'notify_weekly_digest' => 'boolean',
        'dark_mode' => 'boolean',
        'extra' => 'array',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }
}
