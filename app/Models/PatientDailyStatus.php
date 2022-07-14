<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDailyStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'mobile_number',
        'eval_date',
        'follow_rec',
        'recommended_task',
        'how_much_did_you_enjoy_today',
        'failure_reason',
        'what_did_you_enjoy_most_about',
        'best_experience_ever',
        'what_would_have_helped_complete_the_goal',
        'challange_barrier',
        'likelihood_you_will_complete_the_challenge_tomorrow',
        'what_would_make_that_a_ten',
        'how_easy_it_was_the_goal_to_complete',
        'how_fun_was_the_goal',
        'complete_the_goal_tomorrow_rate',
        'start_Time',
        'end_Time',
        'time_diff',
        'ideas_to_make_the_goal_more_easier_or_fun',
        'what_would_make_that_less_than_five',
        'what_will_keep_you_from_getting_bored'
    ];
}
