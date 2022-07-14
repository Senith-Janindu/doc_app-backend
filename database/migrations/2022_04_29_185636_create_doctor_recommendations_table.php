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
        Schema::create('doctor_recommendations', function (Blueprint $table) {
            $table->id()->unique();
            $table->bigInteger('mobile_number');
            $table->foreign('mobile_number')->references('mobile_number')->on('patients');
            $table->longText('recommendation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_recommendations');
    }
};
