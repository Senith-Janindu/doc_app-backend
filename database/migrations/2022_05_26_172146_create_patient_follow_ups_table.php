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
        Schema::create('patient_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mobile_number');
            $table->foreign('mobile_number')->references('mobile_number')->on('patients');
            $table->string('time_start')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('bmi')->nullable();
            $table->string('average')->nullable();
            $table->string('self_eval')->nullable();
            $table->string('last_week_exp')->nullable();
            $table->string('main_barriers')->nullable();
            $table->string('main_posotive_themes')->nullable();
            $table->string('main_negative_themes')->nullable();
            $table->string('new_strategy')->nullable();
//            $table->string('new_strategy_calorie_option')->nullable();
//            $table->string('new_strategy_key_selection')->nullable();
            $table->longText('recommendation_task1')->nullable();
            $table->longText('recommendation_task2')->nullable();
            $table->string('confident_goal_factor')->nullable();
            $table->string('pre_mortem')->nullable();
            $table->string('time_out')->nullable();
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
        Schema::dropIfExists('patient_follow_ups');
    }
};
