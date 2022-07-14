<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTechnologicalLiteracy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'mobile_number',
        'download_use_skill_level',
        'search_online_skill_level',
        'social_media_skill_level',
        'email_usage_skill_level',
        'online_credit_card_usage_skill_level'
    ];
}
