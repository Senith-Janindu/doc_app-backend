<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendedTasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile_number',
        'recommended_tasks',
        'previous_recommended_tasks',

    ];
}
