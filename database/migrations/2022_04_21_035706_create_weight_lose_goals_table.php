<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_lose_goals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mobile_number')->unique();
            $table->foreign('mobile_number')->references('mobile_number')->on('patients');
            $table->integer('goal_id');
//            $table->foreign('goal_id')->references('goal_id')->on('patient_goals');
            $table->string('goal');
            $table->string('target_weight')->nullable();
            $table->string('desired_time_frame')->nullable();
//            $table->string('how_much_do_you_love_food')->nullable();
//            $table->string('how_would_you_rate_your_self_control')->nullable();
//            $table->string('how_many_times_week_do_i_exercise')->nullable();
            $table->string('motivation_factor_for_goal_manual')->nullable();
            $table->string('motivation_factor_for_goal_selected')->nullable();
            $table->integer('level_of_motivation')->nullable();
            $table->string('motivation_target_10_text')->nullable();
            $table->text('contribute_favtors_selected')->nullable();
//            $table->text('contribute_favtors_frequency')->nullable();
//            $table->string('contribute_favtors_manually_added')->$this->nullable();
            $table->string('no_one_fouca_factor')->nullable();
            $table->string('previously_attempted')->nullable();
            $table->string('attempted_yes_success_factors')->nullable();
            $table->string('attempted_yes_success_challenges')->nullable();
            $table->string('attempted_no_success_factors')->nullable();
            $table->string('attempted_no_success_challenges')->nullable();
            $table->string('what_stopped_you_from_continue')->nullable();
            $table->string('what_has_prevented_you_from_restarting')->nullable();
//            $table->string('what_stopped_you_from_continuing_to_lose_weight')->nullable();
//            $table->string('what_has_prevented_you_from_trying_again')->nullable();
//            $table->string('in_the_reasons_for_current_weight')->nullable();
            $table->integer('confident_factor')->nullable();
            $table->string('confident_to_change_encouragement')->nullable();
//            $table->string('how_hard_have_you_really_tried_to_lose_weight')->nullable();
//            $table->string('roughly_how_many_times_have_you_tried')->nullable();
            $table->string('look_forward_factors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_lose_goals');
    }
};
