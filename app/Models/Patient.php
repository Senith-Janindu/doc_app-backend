<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

//    public $timestamps = false;

    protected $primaryKey = 'mobile_number';

    protected $fillable = [
        'mobile_number',
        'first_name',
        'last_name',
        'dob',
        'age',
        'gender',
        'ethnicity',
        'relationship_status',
        'highest_education'
    ];

    public function getPatientMedicalRatio(): HasOne
    {
        return $this->hasOne(PatientMedicalRatio::class,'mobile_number');
    }

    public function getPatientSocialDeterminantsOfHealth(): HasOne
    {
        return $this->hasOne(PatientSocialDeterminantsOfHealth::class,'mobile_number');
    }

    public function getPatientTechnologicalLiteracy(): HasOne
    {
        return $this->hasOne(PatientTechnologicalLiteracy::class,'mobile_number');
    }

    public function getPatientGoal(): HasOne
    {
        return $this->hasOne(PatientGoal::class,'mobile_number');
    }

    public function getPatientRecommendation(): HasOne
    {
        return $this->hasOne(DoctorRecommendation::class,'mobile_number');
    }

    public function getPatientGoalDetails(): HasOne
    {
        return $this->hasOne(WeightLoseGoal::class,'mobile_number');
    }
}
