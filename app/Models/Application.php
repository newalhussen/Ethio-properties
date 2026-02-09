<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'vacancy_id',
        'full_name',
        'gender',
        'field_of_study',
        'educational_level',
        'experience',
        'phone',
        'email',
        'age',
        'year_of_graduation',
        'cv',
        'attachments',
        'comment',
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
