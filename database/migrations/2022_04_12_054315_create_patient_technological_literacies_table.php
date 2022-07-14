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
        Schema::create('patient_technological_literacies', function (Blueprint $table) {
            $table->bigInteger('mobile_number')->unique();
            $table->foreign('mobile_number')->references('mobile_number')->on('patients');
            $table->string('download_use_skill_level');
            $table->string('search_online_skill_level');
            $table->string('social_media_skill_level');
            $table->string('email_usage_skill_level');
            $table->string('online_credit_card_usage_skill_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_technological_literacies');
    }
};
