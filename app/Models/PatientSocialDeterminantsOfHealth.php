<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSocialDeterminantsOfHealth extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'mobile_number',
        'agreeableness_level',
        'extraversion_level',
        'conciousnes_level',
        'openness_level',
        'neuroticism_level'
    ];
}
