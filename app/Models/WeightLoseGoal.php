<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLoseGoal extends Model
{
    use HasFactory;

//    public $timestamps = false;

    protected $fillable = [
        'mobile_number',
        'goal',
        'goal_id',
        'target_weight',
        'desired_time_frame',
        'how_much_do_you_love_food',
        'how_would_you_rate_your_self_control',
        'how_many_times_week_do_i_exercise',
        'motivation_factor_for_goal_manual',
        'motivation_factor_for_goal_selected',
        'level_of_motivation',
        'motivation_target_10_text',
        'contribute_favtors_selected',
        'contribute_favtors_frequency',
//        'contribute_favtors_manually_added',
        'no_one_fouca_factor',
        'previously_attempted',
        'attempted_yes_success_factors',
        'attempted_yes_success_challenges',
        'attempted_no_success_factors',
        'attempted_no_success_challenges',
        'what_stopped_you_from_continue',
        'what_has_prevented_you_from_restarting',
        'what_stopped_you_from_continuing_to_lose_weight',
        'what_has_prevented_you_from_trying_again',
        'in_the_reasons_for_current_weight',
        'confident_factor',
        'confident_to_change_encouragement',
        'how_hard_have_you_really_tried_to_lose_weight',
        'roughly_how_many_times_have_you_tried',
        'look_forward_factors',
    ];
}
