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
        Schema::create('recommended_tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mobile_number');
            $table->foreign('mobile_number')->references('mobile_number')->on('patients');
            $table->text('recommended_tasks')->nullable();
            $table->text('previous_recommended_tasks')->nullable();
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
        Schema::dropIfExists('recommended_tasks');
    }
};
