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
        Schema::create('patient_social_determinants_of_healths', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mobile_number')->unique();
            $table->foreign('mobile_number')->references('mobile_number')->on('patients');
            $table->integer('agreeableness_level');
            $table->integer('extraversion_level');
            $table->integer('conciousnes_level');
            $table->integer('openness_level');
            $table->integer('neuroticism_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_social_determinants_of_healths');
    }
};
