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
        Schema::create('patient_medical_ratios', function (Blueprint $table) {
            $table->bigInteger('mobile_number')->unique();
            $table->foreign('mobile_number')->references('mobile_number')->on('patients');
            $table->string('weight');
            $table->string('height');
            $table->string('bmi');
            $table->integer('waist');
            $table->integer('hip');
            $table->integer('waist_hip_ratio');
            $table->string('bp');
            $table->string('lipid_pannel');
            $table->string('a1c');
            $table->longText('current_health_status');
            $table->longText('anyone_in_family_overweight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_medical_ratios');
    }
};
