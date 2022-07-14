<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientMedicalRatio extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'mobile_number',
        'weight',
        'height',
        'bmi',
        'waist',
        'hip',
        'waist_hip_ratio',
        'bp',
        'lipid_pannel',
        'a1c',
        'current_health_status',
        'anyone_in_family_overweight'
    ];

//    public function getPatientMedicalRatioByPhoneNumber(): HasOne
//    {
//        return $this->hasOne(Patient::class, 'phone_number');
//    }
}
