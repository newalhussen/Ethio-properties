<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    use HasFactory;
    protected $fillable = [
        'siteTitle',
        'SiteMoto',
        'logo_transparent',
        'logo_white',
        'logo_footer',
        'favicon',
        'keywords',
        'sitedescription',
        'no_livers',
        'no_projects',
        'no_services',
        'no_hours',
        'no_social',
        'footer_note',
        'contact_note',
        'about_image',
        'about_note',
        'vision',
        'mission',
        'objectives',
        'values',
        'focuses',
        'footer_note_am',
        'contact_note_am',
        'about_note_am',
        'vision_am',
        'mission_am',
        'objectives_am',
        'values_am',
        'focuses_am',
        'footer_note_or',
        'contact_note_or',
        'about_note_or',
        'vision_or',
        'mission_or',
        'objectives_or',
        'values_or',
        'focuses_or',
        'phone',
        'emailNoReply',
        'emailInfo',
        'google_map',
        'about_us',
        'facebook',
        'instagram',
        'youtube',
        'telegram',
        'twitter',
        'whatsapp',
        'working_hours',
    ];
}
